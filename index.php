<?php

require 'vendor/autoload.php';
include_once 'config/db.php';
include_once 'entities/food.php';
require 'controller/controller.php';
header("Content-Type: application/json; charset=UTF-8");

$app = new Slim\App();

$app->get('/fetchFoodData/{id}', function ($request, $response, $args) {
    $food = new fetchFoodData($args['id']);
    $content_type = 'application/json;charset=utf-8';
    return $response->getBody()->write($food);

});
$app->get('/helloo/{name}', function ($request, $response, $args) {
    return $response->getBody()->write("Hello000000000000, " . $args['name']);
});

$app->run();