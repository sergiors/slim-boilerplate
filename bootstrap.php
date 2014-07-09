<?php

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Configuration;
use Doctrine\Common\Cache\ArrayCache;

$loaderPath = __DIR__ . "/vendor/autoload.php";

if (! is_readable($loaderPath)) {
  throw new \Exception("Run \"php composer.php\" to install first");
}

$loader = require $loaderPath;
$loader->add("Entities", __DIR__ . "/src");

$config = new Configuration();

$driveImpl = $config->newDefaultAnnotationDriver([
  __DIR__ . "/src/Entities"
]);
$config->setMetadataDriverImpl($driveImpl);

$cache = new ArrayCache();
$config->setMetadataCacheImpl($cache);
$config->setQueryCacheImpl($cache);

$config->setProxyDir(__DIR__ . "/cache");
$config->setProxyNamespace("Proxies");

$db = [
  "driver" => "pdo_mysql",
  "host" => "localhost",
  "user" => "root",
  "pass" => "",
  "dbname" => "exp_slim_doctrine" 
];

return EntityManager::create($db, $config);
