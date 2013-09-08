<?php

namespace Rubs\Core;

\Rubs\Loader::uses('Rubs\\Exceptions\\*', true);

/**
 * Code vérifiant la validité des données du cube...
 */
class Security {

	/**
	 * Couleurs valides
	 * @var array
	 */
	protected $_colors;

	/**
	 * Vérifie si les couleurs sont bien 6 et différentes
	 * @param array $colors Tableau des 6 couleurs du cube
	 * @throws InvalidColorException
	 */
	public function __construct(array $colors) {
		if (count($colors) != 6) {
			throw new InvalidColorException("6 Couleurs... Pas plus pas moins");
		}

		$checkedColors = [];
		foreach ($colors as $color) {
			if (in_array($color, $checkedColors)) {
				throw new InvalidColorException('Les 6 couleurs doivent être différentes');
			}
			$checkedColors[] = $color;
		}
		$this->_colors = $colors;
	}

	/**
	 * Vérifie si une face est valide
	 * @param  array   $face Face à vérifier
	 * @return boolean
	 *
	 * @throws InvalidFaceException
	 */
	public function is_face(array $face) {
		if (count($face) != 3) {
			throw new InvalidFaceException();
		}
		foreach ($face as $line) {
			if(!$this->is_line($line)) {
				throw new InvalidFaceException();
			}
		}

		return true;
	}

	public function is_face_number($number) {
		if($number < 0 || $number > 5) {
			throw new InvalidFaceNumberException();
		}

		return true;
	}

	/**
	 * Vérifie si une ligne est valide
	 * @param  array   $line Ligne à vérifier
	 * @return boolean
	 *
	 * @throws InvalidLineException
	 */
	public function is_line(array $line) {
		if (count($line) == 3) {
			return true;
		}

		throw new InvalidLineException();
	}

	/**
	 * Vérifie si le cube est résolvable
	 * @param  array  $cube
	 * @return boolean
	 *
	 * @todo Implementing it
	 */
	public function is_solvable($cube) {
		//
	}

}
