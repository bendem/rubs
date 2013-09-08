<?php

namespace Rubs;

Loader::uses('Rubs\\Core\\Display');
Loader::uses('Rubs\\Core\\Generator');
Loader::uses('Rubs\\Core\\Getter');
Loader::uses('Rubs\\Core\\Logger');
Loader::uses('Rubs\\Core\\Logic');
Loader::uses('Rubs\\Core\\Movements');
Loader::uses('Rubs\\Core\\Security');
Loader::uses('Rubs\\Core\\Setter');


class Cube {

	use Core\Movements, Core\Generator, Core\Display, Core\Logic, Core\Getter, Core\Setter;

	protected $cube = [];
	protected $ended = false;
	protected $security;

	/**
	 * Commence l'écoute html et génère le cube
	 */
	public function __construct() {
		ob_start();
		$this->security = new Core\Security($this->colors);
		$this->generate();
	}

	/**
	 * Arrête l'écoute html et charge le layout
	 */
	public function end() {
		if(!$this->ended) {
			$this->ended = true;
			$content = ob_get_clean();
			require APP . DS . 'html' . DS . 'layout.php';
			Core\Logger::save();
		}
	}

	/**
	 * Assure de lancer la fonction ``$this->end()`` même en cas d'oublis
	 */
	public function __destruct()  {
		$this->end();
	}

}
