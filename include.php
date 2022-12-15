<?php

use Bitrix\Main\Application;
use Bitrix\Main\DI\ServiceLocator;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;

if (file_exists(__DIR__ . '/vendor/autoload.php')) {
    require_once(__DIR__ . '/vendor/autoload.php');
}

$paths = [__DIR__. '/lib/Entity'];
$isDevMode = false;

$bitrixConnectionConfig = Application::getConnection()->getConfiguration();
$serviceLocator = ServiceLocator::getInstance();
$dbParams = [
    'driver' => 'pdo_mysql',
    'user' => $bitrixConnectionConfig['login'],
    'password' => $bitrixConnectionConfig['password'],
    'dbname' => $bitrixConnectionConfig['database'],
    'host' => $bitrixConnectionConfig['host'],
    'charset' => 'utf8',
];

$config = ORMSetup::createAnnotationMetadataConfiguration($paths, $isDevMode);
$entityManager = EntityManager::create($dbParams, $config);
$serviceLocator->addInstance('baarlord.officemap.doctrineEntityManager', $entityManager);
