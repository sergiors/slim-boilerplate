<?php
$entityManager = require __DIR__ . "/bootstrap.php";

$app = new \Slim\Slim();

$app->get("/", function() use ($app, $entityManager) {
  $users = $entityManager
    ->getRepository("Entities\User")
    ->findAll();

  foreach($users as $user) {
    echo $user->getName();
  }
});

$app->run();
