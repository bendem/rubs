<?php

namespace Rubs\Core;

\Rubs\Loader::uses('Rubs\Utils\Utils');

/**
 * Code permettant de récupérer des informations sur le cube,
 * ses face, ses blocks
 */
trait Getter {

	/**
	 * HARDCODE !
	 * Retourne la face opposée
	 * @param  int $face
	 * @return int
	 */
	public function getOppositeFace($face) {
		switch ($face) {
			case 0:
				return 5;
			case 1:
				return 3;
			case 2:
				return 4;
			case 3:
				return 1;
			case 4:
				return 2;
			case 5:
				return 0;
		}
	}

	/**
	 * Retourne une face du cube
	 * @param  int    $face Numéro de la face
	 * @return array  Face du cube
	 */
	public function getFace($face) {
		return $this->cube[$face];
	}

	/**
	 * Retourne le numéro des faces adjacentes
	 * @param  int $face Numéro de la face
	 * @return array
	 */
	public function getAdjacentsFaces($face) {
		// ``array_values`` sert à réattribuer correctement les indices...
		return array_values(array_diff(range(0, 5), [$face, $this->getOppositeFace($face)]));
	}

	/**
	 * Retourne le numéro des faces adjacentes en faisant le tour du cube
	 * (Les faces opposées ne se suivent pas)
	 * @param  int $face Numéro de la face
	 * @return array
	 */
	public function getRoundedAdjacentsFaces($face) {
		$adj = $this->getAdjacentsFaces($face);

		for ($i = 0; $i < count($adj) / 2; $i++) {
			if($adj[$i + 1] == $this->getOppositeFace($adj[$i])) {
				\Rubs\Utils\Utils::reverse($adj[$i + 1], $adj[$i + 2]);
			}
		}

		return $adj;
	}

	/**
	 * Retourne la ligne séparant deux faces
	 * @param  int $face1 Numéro de la face 1
	 * @param  int $face2 Numéro de la face 2
	 * @return array 	- (bool)  ``col``    : Si la ligne retournée en une colonne
	 *         		 	- (int)   ``number`` : Indice de la ligne / colonne
	 *         		 	- (array) ``face1``  : Ligne de la première face
	 *         		 	- (array) ``face2``  : Ligne de la deuxième face
	 */
	public function getAdjacentLine($face1, $face2) {
		// TODO : WIP
		$this->security->canBeAdjacent($face1, $face2);
		return [
			'col' => true,
			'number' => [0, 2][rand(0, 1)],
			'face1' => ['r', 'r', 'r'],
			'face2' => ['w', 'w', 'w'],
		];
	}

	/**
	 * Renvoie les blocks adjacents à deux faces
	 * @param  int $face1 Face 1
	 * @param  int $face2 Face 2
	 * @return ?
	 *
	 * @todo  implementing it
	 */
	public function getAdjacentsBlocks($face1, $face2) {
	}

	/**
	 * HARDCODE !
	 * Retourne la position relative d'une face par rapport à une autre
	 * @param  int $face1 Première face
	 * @param  int $face2 Deuxième face
	 * @return string 'left', 'right', 'top', 'bottom'
	 */
	public function getRelativePosition($face1, $face2) {
		switch ($face1) {
			case 0:
				switch ($face2) {
					case 1: return 'left';
					case 2: return 'bottom';
					case 3: return 'right';
					case 4: return 'top';
				}
			case 1:
				switch ($face2) {
					case 0: return 'top';
					case 2: return 'right';
					case 4: return 'left';
					case 5: return 'bottom';
				}
			case 2:
				switch ($face2) {
					case 0: return '';
					case 1: return 'right';
					case 3: return 'left';
					case 5: return 'bottom';
				}
		}
	}

}
