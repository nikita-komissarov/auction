<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();

$apiVersion = '/api/v1';

$app->post($apiVersion.'/admin/item/create', function (Request $request, Response $response, $args) {
  $response->getBody()->write(json_encode([]));
  return $response;
});

$app->run();
