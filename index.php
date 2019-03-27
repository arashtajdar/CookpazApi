<?php

require 'vendor/autoload.php';
include_once 'config/db.php';
include_once 'entities/food.php';
require 'controller/controller.php';

$app = new Slim\App();

$app->get('/fetchFoodData/{id}', function ($request, $response, $args) {
    $food = fetchFoodData($args['id']);
    return $response->withStatus(200)
    ->withHeader('Content-Type', 'application/json')
    ->write($food);
});
$app->get('/fetchSteps/{id}', function ($request, $response, $args) {
    $steps = fetchSteps($args['id']);
    return $response->withStatus(200)
    ->withHeader('Content-Type', 'application/json')
    ->write($steps);
});
$app->get('/search', function ($request, $response, $args) {
    $result = search($args['id']);
    return $response->withStatus(200)
    ->withHeader('Content-Type', 'application/json')
    ->write($result);
});


$app->run();
