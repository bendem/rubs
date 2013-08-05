<?php

define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(__FILE__));
define('LIBS_DIR', ROOT . DS . 'libs');
define('HTML_DIR', ROOT . DS . 'html');

require LIBS_DIR . DS . 'includes.php';
require 'cube.php';

$cube = new Cube();

$cube->display();

$cube->end();
