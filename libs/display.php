<?php

/**
 * Code gérant l'affichage du cube
 */
trait Display {

	/**
	 * Affiche le cube
	 */
	public function display() {
		$this->_face_number = $j = 0;

		echo '<div class="cube">';
		foreach ($this->cube as $face) {
			if ($this->_face_number == 0 || $this->_face_number == 5) {
				echo '<br>';
				$this->_displayFace();
			}

			$this->_displayFace($face, ++$j);

			if ($this->_face_number == 0 || $this->_face_number == 5) {
				for ($k = 0; $k < 2; $k++) {
					$this->_displayFace();
				}
				echo '<br>';
			}
			$this->_face_number++;
		}
		echo '</div>';
	}

	/**
	 * Affiche une face du cube
	 * @param  array $face Tableau contenant la face du cube
	 * @param  bool  $face Si faux, affiche une face vide (utile pour l'affichage)
	 */
	protected function _displayFace($face = false) {
		if($face) {
			echo '<div class="face face' . $this->_face_number . '" data-face="' . $this->_face_number . '">';
			$this->_displayLine($face[0]);
			$this->_displayLine($face[1], $this->_face_number);
			$this->_displayLine($face[2]);
		} else {
			echo '<div class="face face-empty">';
			for ($i = 0; $i < 3; $i++) {
				$this->_displayLine();
			}
		}
		echo '</div>';
	}

	/**
	 * Affiche une ligne
	 * @param  array $line        Tableau contenant la ligne à afficher
	 * @param  bool  $line        Si faux, affiche une ligne vide (utile pour l'affichage)
	 * @param  int   $face_number Numéro de la face
	 */
	protected function _displayLine($line = false, $face_number = null) {
		echo '<div class="line">';
		if($line) {
				$this->_displaySquare($line[0]);
				$this->_displaySquare($line[1], $face_number);
				$this->_displaySquare($line[2]);
		} else {
			for ($i=0; $i < 3; $i++) {
				for ($i=0; $i < 3; $i++) {
					$this->_displaySquare();
				}
			}
		}
		echo '</div>';
	}

	/**
	 * Affiche un carré
	 * @param  char $colorCode   Code couleur du carré
	 * @param  bool $colorCode   Si faux, Carré vide (utile pour l'affichage)
	 * @param  int  $face_number Numéro de la face à afficher
	 */
	protected function _displaySquare($colorCode = false, $face_number = null) {
		echo '<span class="' . $colorCode . ' square">' . $face_number . '</span>';
	}

}
