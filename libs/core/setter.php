<?php

namespace Rubs\Core;

\Rubs\Loader::uses('Rubs\Core\Security');

/**
 * Code gérant les modifications du cube
 * Utilise la classe ``Security`` pour vérifier la validité des données
 */
trait Setter {

	public function setCube($cube) {
		$this->security->is_valid_cube($cube);
		$this->cube = $cube;
	}

	public function setFace($face, $data) {
		$this->security->isFace($data);
		$this->security->isFaceNumber($face);

		$this->cube[$face] = $data;
	}

	public function setLine($face, $line, $data) {
	}

	public function setCol($face, $col, $data) {
	}


}
