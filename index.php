<?php

require 'vendor/autoload.php';
require 'config/db.php';
require 'entities/category.php';
require 'entities/food.php';
require 'entities/recipe.php';
require 'entities/step.php';
require 'controller/controller.php';

$app = new Slim\App();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$app->get('/fetchFoodData/{id}', function ($request, $response, $args) {
    $food = fetchFoodData($args['id']);
    return $response->withStatus(200)
    ->withHeader('Content-Type', 'application/json')
    ->write($food);
});
$app->get('/fetchSteps/{id}', function ($request, $response, $args) {
  // var_dump($request->getParsedBody()["id"]);
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
$app->get('/addcategory/{name}', function ($request, $response, $args) {
    $result = addCategory($args['name']);
    return $response->withStatus(200)
    ->withHeader('Content-Type', 'application/json')
    ->write($result);
});

$app->get('/editcategory/{id}/{name}', function ($request, $response, $args) {
    $result = editCategory($args['id'],$args['name']);
    return $response->withStatus(200)
    ->withHeader('Content-Type', 'application/json')
    ->write($result);
});
$app->get('/fetchallcategories', function ($request, $response, $args) {
    $result = fetchAllCategories();
    return $response->withStatus(200)
    ->withHeader('Content-Type', 'application/json')
    ->write($result);
});
$app->get('/removeCategory/{id}', function ($request, $response, $args) {
    $result = removeCategory($args['id']);
    return $response->withStatus(200)
    ->withHeader('Content-Type', 'application/json')
    ->write($result);
});
$app->get('/addRecipe/{name}', function ($request, $response, $args) {
    $result = addRecipe($args['name']);
    return $response->withStatus(200)
    ->withHeader('Content-Type', 'application/json')
    ->write($result);
});
$app->get('/editRecipe/{id}/{name}', function ($request, $response, $args) {
    $result = editRecipe($args['id'],$args['name']);
    return $response->withStatus(200)
    ->withHeader('Content-Type', 'application/json')
    ->write($result);
});
$app->get('/fetchAllRecipes', function ($request, $response, $args) {
    $result = fetchAllRecipes();
    return $response->withStatus(200)
    ->withHeader('Content-Type', 'application/json')
    ->write($result);
});
$app->get('/removeRecipe/{id}', function ($request, $response, $args) {
    $result = removeRecipe($args['id']);
    return $response->withStatus(200)
    ->withHeader('Content-Type', 'application/json')
    ->write($result);
});


$app->run();
