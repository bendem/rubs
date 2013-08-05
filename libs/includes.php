<?php

/**
 * Fonction d'autochargement des classes
 * @param  str $name Nom de la classe à charger
 */
function autoload($name) {
	require LIBS_DIR . DS . strtolower($name) . '.php';
	Logger::debug("$name loaded...");
}

spl_autoload_register('autoload');
