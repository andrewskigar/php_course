<?php

use App\Clients\CachedCatClient;
use App\Clients\CatClient;
use App\Clients\StubbedCatClient;
use App\Contracts\CatClientInterface;
use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\MessageFormatter;
use GuzzleHttp\Middleware;
use Monolog\Handler\StreamHandler;
use Monolog\Level;
use Monolog\Logger;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ResponseInterface;

return [
    'global.env' => 'production',
    'global.debug' => true,
    'global.cache' => true,

    ClientInterface::class => function (ContainerInterface $c) {
        $options = [
            'base_uri' => 'https://api.thecatapi.com/v1/',
            'headers' => [
                'x-api-key' => $_ENV['CAT_API_KEY'],
            ],
            'timeout' => 10,
        ];

        if ($c->get('global.debug')) {
            $logger = new Logger('GuzzleLogger');
            $logger->pushHandler(new StreamHandler(__DIR__ . '/../logs/http_client.log', Level::Debug));

            $stack = HandlerStack::create();
            $stack->push(Middleware::mapResponse(function(ResponseInterface $response) {
                $response->getBody()->rewind();
                return $response;
            }));
            $stack->push(Middleware::log($logger, new MessageFormatter('{method} - {code} - {uri} - {req_body} - {res_body}')));

            $options['handler'] = $stack;
        }

        return new Client($options);
    },
    CatClientInterface::class => function (ClientInterface $httpClient, ContainerInterface $c) {
        if ($c->get('global.env') === 'development') {
            return new StubbedCatClient();
        }

        return $c->get('global.cache') ? new CachedCatClient(new CatClient($httpClient)) : new CatClient($httpClient);
    },
];
