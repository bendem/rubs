<?php

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(__FILE__));
define('LIBS_DIR', ROOT . DS . 'libs');
define('HTML_DIR', ROOT . DS . 'html');
define('LOG_DIR', ROOT . DS . 'logs');

require LIBS_DIR . DS . 'includes.php';
require 'cube.php';

$cube = new Rubs\Cube();

$cube->display();
// $cube->randomize(5, 15);
$cube->rotate(2, false, 1);
$cube->display();

$cube->end();
