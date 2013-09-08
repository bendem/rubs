<?php

namespace Rubs\Core;

\Rubs\Loader::uses('Rubs\Core\Security');

/**
 * Code gérant les modifications du cube
 * Utilise la classe ``Security`` pour vérifier la validité des données
 */
trait Setter {

	public function setFace($face, $data) {
		$this->security->is_face($data);
		$this->security->is_face_number($face);

		$this->cube[$face] = $data;
	}

	public function setLine($face, $line, $data) {
	}

	public function setCol($face, $col, $data) {
	}


}
