<?php

require __DIR__ . '/../vendor/autoload.php';

$loader= new Composer\Autoload\ClassLoader();
$loader->addPsr4('CodePress\\CodeTag\\', __DIR__ . '/../../codetags/src/CodeTag');
$loader->addPsr4('CodePress\\CodeCategory\\', __DIR__ . '/../../codecategories/src/CodeCategory');
$loader->register();