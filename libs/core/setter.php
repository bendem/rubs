<?php

namespace Rubs;

/**
 * Code gérant les modifications du cube
 * Utilise la classe ``Security`` pour vérifier la validité des données
 */
trait Setter {

	public function setFace($face, $data) {
		if ($this->security->is_face($data)) {
			$this->cube[$face] = $data;
		} else {
			throw new InvalidFaceException("Face incorrect");
		}
	}

	public function setLine($face, $line, $data) {
	}

	public function setCol($face, $col, $data) {
	}


}
