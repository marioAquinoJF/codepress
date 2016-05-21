<?php

require __DIR__ . '/../vendor/autoload.php';

$loader= new Composer\Autoload\ClassLoader();
$loader->addPsr4('CodePress\\CodePost\\', __DIR__ . '/../../codeposts/src/CodePost');
$loader->register();