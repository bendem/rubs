<?php

namespace Rubs;

class Cube {

	use Movements, Generator, Display, Logic, Getter;

	protected $cube = [];
	protected $ended = false;

	/**
	 * Commence l'écoute html et génère le cube
	 */
	public function __construct() {
		ob_start();
		$this->security = new security($this->colors);
		$this->generate();
	}

	/**
	 * Arrête l'écoute html et charge le layout
	 */
	public function end() {
		if(!$this->ended) {
			$this->ended = true;
			$content = ob_get_clean();
			require HTML_DIR . DS . 'layout.php';
			Logger::save();
		}
	}

	/**
	 * Assure de lancer la fonction ``$this->end()`` même en cas d'oublis
	 */
	public function __destruct()  {
		$this->end();
	}

}
