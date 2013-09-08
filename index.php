<?php

define('DS', DIRECTORY_SEPARATOR);
define('APP', dirname(__FILE__));

require APP . DS . 'libs' . DS . 'includes.php';
require 'cube.php';

$cube = new Rubs\Cube();

$cube->display();
// $cube->randomize(5, 15);
$cube->rotate(2, false, 1);
$cube->rotate(2, false, 1);
$cube->display();

$cube->end();
