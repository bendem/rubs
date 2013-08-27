<?php

namespace Rubs;

/**
 * Code permettant de récupérer des informations sur le cube,
 * ses face, ses blocks
 */
trait Getter {

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
	 * Renvoie les blocks adjacents à deux faces
	 * @param  int $face1 Face 1
	 * @param  int $face2 Face 2
	 * @return ?
	 *
	 * @todo  implementing it
	 */
	public function getAdjacentsBlocks($face1, $face2) {
	}

}
