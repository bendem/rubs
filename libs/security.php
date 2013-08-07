<?php

/**
 * Code vérifiant la validité des données du cube...
 */
class Security {

	protected $_colors;

	public function __construct($colors) {
		if(count($colors) == 6) {
			$this->_colors = $colors;
		} else {
			throw new IllegalArgumentException("6 Couleurs... Pas plus pas moins");
		}
	}

	public function is_face(array $face) {
		if(count($face) != 3) {
			return false;
		}
		foreach ($face as $line) {
			if(!$this->is_line($line)) {
				return false;
			}
		}

		return true;
	}

	public function is_line(array $line) {
		return count($line == 3);
	}

	/**
	 * Vérifie si le cube est résolvable
	 * @param  array  $cube
	 * @return boolean
	 *
	 * @todo Implementing it
	 */
	public function is_solvable($cube) {}

}
