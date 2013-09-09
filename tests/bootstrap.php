<?php

error_reporting(E_ALL);

define('DS', DIRECTORY_SEPARATOR);
define('APP', dirname(dirname(__FILE__)));
define('TMP', APP . DS . 'tests' . DS . 'tmp');

function delTree($dir) {
	$files = array_diff(scandir($dir), array('.','..'));
	foreach ($files as $file) {
		(is_dir($dir . DS . $file)) ? $this->delTree($dir . DS . $file) : unlink($dir . DS . $file);
	}
	return rmdir($dir);
}

require APP . DS . 'libs' . DS . 'loader.php';

delTree(TMP);
