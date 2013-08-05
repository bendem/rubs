<?php

class Cube {

	use Movements, Generator, Display;

	protected $cube = [];

	/**
	 * Commence l'écoute html et génère le cube
	 */
	public function __construct() {
		ob_start();
		$this->generate();
	}

	/**
	 * Arrête l'écoute html et charge le layout
	 */
	public function end() {
		$content = ob_get_clean();
		require HTML_DIR . DS . 'layout.php';
	}

}
