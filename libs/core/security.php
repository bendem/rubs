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
			throw new \Rubs\Exceptions\InvalidColorException("6 Couleurs... Pas plus pas moins");
		}

		$checkedColors = [];
		foreach ($colors as $color) {
			if (in_array($color, $checkedColors)) {
				throw new \Rubs\Exceptions\InvalidColorException('Les 6 couleurs doivent être différentes');
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
	public function isFace(array $face) {
		if (count($face) != 3) {
			throw new \Rubs\Exceptions\InvalidFaceException();
		}
		foreach ($face as $line) {
			if(!$this->isLine($line)) {
				throw new \Rubs\Exceptions\InvalidFaceException();
			}
		}

		return true;
	}

	/**
	 * Vérifie si un numéro de face est correct
	 * @param  int  $number Numéro de face
	 * @throws InvalidFaceNumberException
	 */
	public function isFaceNumber($number) {
		if($number < 0 || $number > 5) {
			throw new \Rubs\Exceptions\InvalidFaceNumberException();
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
			throw new \Rubs\Exceptions\CantBeAdjacentException($face1, $face2);
		}
	}

	/**
	 * Vérifie si une ligne est valide
	 * @param  array   $line Ligne à vérifier
	 * @return boolean
	 *
	 * @throws InvalidLineException
	 */
	public function isLine(array $line) {
		if (count($line) == 3) {
			return true;
		}

		throw new \Rubs\Exceptions\InvalidLineException();
	}

	public function isValidCube($cube) {
		// TODO : Implement it
		return $this->isSolvable($cube);
	}

	/**
	 * Vérifie si le cube est résolvable
	 * @param  array  $cube
	 * @return boolean
	 *
	 * @todo Implementing it
	 */
	public function isSolvable($cube) {
		return true;
	}

}
