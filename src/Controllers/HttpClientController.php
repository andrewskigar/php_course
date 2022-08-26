<?php

namespace App\Controllers;

use App\Contracts\CatClientInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

class HttpClientController
{

    protected CatClientInterface $catApiClient;

    public function __construct(CatClientInterface $catApiClient)
    {
        $this->catApiClient = $catApiClient;
    }

    public function index(Response $response): Response
    {
        return $response
            ->withHeader('Location', 'http://localhost:8000/breeds')
            ->withStatus(302);
    }

    public function breeds(Response $response): Response
    {
        $breeds = $this->catApiClient->breeds();
        $template = include_once __DIR__ . "/../../templates/breeds.tpl.php";
        $response->getBody()->write($template);
        return $response;
    }

    public function images(string $breed_id, Response $response): Response
    {
        $images = $this->catApiClient->images($breed_id);
        $template = include_once __DIR__ . "/../../templates/images.tpl.php";
        $response->getBody()->write($template);
        return $response;
    }
}
