<?php

require __DIR__ . "/../vendor/autoload.php";

define("MODELS_DIR", __DIR__ . "/models");

$configurator = new Nette\Configurator;

$configurator->enableDebugger(__DIR__ . "/../log");

$configurator->setTempDirectory(__DIR__ . "/../temp");

$configurator->createRobotLoader()
    ->addDirectory(__DIR__)
    ->addDirectory(__DIR__ . "/../libs")
    ->register();

$configurator->addConfig(__DIR__ . "/config/config.neon", \Nette\Configurator::AUTO);
$configurator->addConfig(__DIR__ . "/config/config.local.neon", \Nette\Configurator::AUTO);

$container = $configurator->createContainer();

\Tracy\Debugger::$maxDepth = 7;
\Tracy\Debugger::$maxLen = 5000;
\Dibi\Bridges\Tracy\Panel::$maxLength = 5000;

$container->createServiceObo()->run();

return $container;
