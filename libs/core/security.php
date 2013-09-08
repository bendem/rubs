<?php

namespace Rubs\Core;

\Rubs\Loader::uses('Rubs\Exceptions\*', true);

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
	 * Rubs\Cube
	 * @var [type]
	 */
	protected $_cube;

	/**
	 * Vérifie si les couleurs sont bien 6 et différentes
	 * @param array      $colors Tableau des 6 couleurs du cube
	 * @param \Rubs\Cube $cube
	 * @throws InvalidColorException
	 */
	public function __construct(array $colors, \Rubs\Cube $cube) {
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
		$this->_cube = $cube;
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

	/**
	 * Vérifie si un numéro de face est correct
	 * @param  int  $number Numéro de face
	 * @throws InvalidFaceNumberException
	 */
	public function is_face_number($number) {
		if($number < 0 || $number > 5) {
			throw new InvalidFaceNumberException();
		}

		return true;
	}

	/**
	 * Vérifie si deux faces peuvent être adjacentes
	 * @param  int $face1
	 * @param  int $face2 [description]
	 * @throws CantBeAdjacentException
	 */
	public function canBeAdjacent($face1, $face2) {
		if($this->_cube->getOppositeFace($face1) == $face2) {
			throw new CantBeAdjacentException($face1, $face2);
		}
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
