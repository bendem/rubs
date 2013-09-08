<?php

namespace Rubs\Core;

\Rubs\Loader::uses('Rubs\Core\Logger');
\Rubs\Loader::uses('Rubs\Core\Setter');

/**
 * Code permettant la génération du cube
 */
trait Generator {

	/**
	 * Couleurs utilisées par les cube
	 * @var array
	 */
	public $colors = ['w', 'g', 'r', 'b', 'o', 'y'];

	/**
	 * Génère un cube
	 * @return [type] [description]
	 */
	public function generate() {
		Logger::info('Generating cube...');
		foreach ($this->colors as $k => $color) {
			$this->setFace($k, $this->generatePlainFace($color));
		}
		Logger::info('Cube generated');
	}

	/**
	 * Génère une face de cube
	 * @param  char $color Code couleur de la face
	 * @return array
	 */
	protected function generatePlainFace($color = null) {
		$a = [];
		for ($i = 0; $i < 3; $i++) {
			for ($j = 0; $j < 3; $j++) {
				$a[$i][$j] = $color;
			}
		}

		return $a;
	}

	/**
	 * Fait tourner les faces du cube aléatoirement
	 */
	public function randomize($min = 50, $max = 100) {
		Logger::info('Randomizing...');
		$rand = rand($min, $max);

		for ($i = 0; $i < $rand; $i++) {
			$this->rotate(rand(0, 5), rand(0, 1), rand(1, 2));
		}
	}

}
