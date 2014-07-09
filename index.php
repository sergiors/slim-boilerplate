<?php

$entityManager = require __DIR__ . "/bootstrap.php";

$app = new \Slim\Slim([
  "templates.path" => __DIR__ . "/templates",
  "view" => new \Slim\Views\Twig()
]);

$view = $app->view();
$view->parserOptions = [
  "cache" => __DIR__ . "/cache",
];
$view->parserExtensions = [
  new \Slim\Views\TwigExtension()
];

$app->get("/", function() use ($app, $entityManager) {
  $users = $entityManager
    ->getRepository("Entities\User")
    ->findAll();

  foreach($users as $user) {
    echo $user->getName();
  }
});

$app->get("/hello", function() use ($app) {
  $app->render("index.twig");
});

$app->run();
