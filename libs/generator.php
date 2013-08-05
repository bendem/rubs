<?php

trait Generator {

	public $colors = ['w', 'g', 'r', 'b', 'o', 'y'];

	/**
	 * Génère un cube
	 * @return [type] [description]
	 */
	public function generate() {
		foreach ($this->colors as $color) {
			$this->cube[] = $this->generatePlainFace($color);
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
	public function randomize() {
	}

}
