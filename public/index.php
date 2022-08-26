<?php

use App\Controllers\HttpClientController;
use DI\Bridge\Slim\Bridge;
use DI\ContainerBuilder;

require __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__. '/../');
$dotenv->load();

try {
    $builder = new ContainerBuilder();
    $builder->addDefinitions(__DIR__ . '/../configs/container.php');
    $container = $builder->build();
} catch (Exception $e) {
    die($e->getMessage());
}

$app = Bridge::create($container);

$app->get('/', [HttpClientController::class, 'index']);
$app->get('/breeds', [HttpClientController::class, 'breeds']);
$app->get('/images/{breed_id}', [HttpClientController::class, 'images']);

$app->run();
