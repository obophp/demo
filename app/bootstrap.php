<?php

require __DIR__ . '/../vendor/autoload.php';

$configurator = new Nette\Configurator;

$configurator->enableDebugger(__DIR__ . '/../log');

$configurator->setTempDirectory(__DIR__ . '/../temp');

$configurator->createRobotLoader()
    ->addDirectory(__DIR__)
    ->addDirectory(__DIR__ . "/../libs")
    ->register();

$configurator->addConfig(__DIR__ . '/config/config.neon', \Nette\Configurator::AUTO);
$configurator->addConfig(__DIR__ . '/config/config.local.neon', \Nette\Configurator::AUTO);

$container = $configurator->createContainer();

$container->createServiceObo()->run();

return $container;


