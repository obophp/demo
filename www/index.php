<?php

$container = include __DIR__ . '/../app/bootstrap.php';

$container->getService('application')->run();
