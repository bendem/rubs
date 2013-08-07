<?php

namespace Rubs;

/**
 * Code permettant de récupérer des informations sur le cube,
 * ses face, ses blocks
 */
trait Getter {

	public function oppositeFace($face) {
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
	 * @param  array  $data Si précisé, remplace la face par celle-ci
	 * @return array  Face du cube
	 */
	public function face($face, array $data = array()) {
		if(!empty($data)) {
			if($this->security->is_face($data)) {
				$this->cube[$face] = $data;
			} else {
				throw new IllegalArgumenException("Face incorrect");
			}
		}

		return $this->cube[$face];
	}

	/**
	 * Retourne le numéro des faces adjacentes
	 * @param  int $face Numéro de la face
	 * @return array
	 */
	public function adjacentsFaces($face) {
		// ``array_values`` sert à réattribuer correctement les indices...
		return array_values(array_diff([0, 1, 2, 3, 4, 5], [$face, $this->oppositeFace($face)]));
	}

	/**
	 * Renvoie les blocks adjacents à deux faces
	 * @param  int $face1 Face 1
	 * @param  int $face2 Face 2
	 * @return ?
	 *
	 * @todo  implementing it
	 */
	public function adjacentsBlocks($face1, $face2) {
	}
}
