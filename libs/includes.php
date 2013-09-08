<?php

/**
 * Fonction d'autochargement des classes
 * @param  str $name Nom de la classe à charger
 */
// function autoload($name) {
// 	require APP . DS . 'libs' . DS . strtolower($name) . '.php';
// 	Logger::debug("$name loaded...");
// }

// spl_autoload_register('autoload');
function loadDir($dir) {
	foreach (array_diff(scandir($dir), ['.', '..', '.htaccess']) as $file) {
		if (is_file($dir . DS . $file) && basename($file) != basename(__FILE__)) {
			require $dir . DS . $file;
		} elseif (is_dir($dir . DS . $file)) {
			loadDir($dir . DS . $file);
		}
	}
}

loadDir(APP . DS . 'libs');
