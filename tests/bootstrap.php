<?php

error_reporting(E_ALL);

define('DS', DIRECTORY_SEPARATOR);
define('APP', dirname(dirname(__FILE__)));
define('TMP', APP . DS . 'tests' . DS . 'tmp');

require APP . DS . 'libs' . DS . 'loader.php';
