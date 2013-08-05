<?php

trait Movements {

	/**
	 * Fait tourner une des faces du cube
	 * @param  int $face      Numéro de la face
	 * @param  str $direction Sens de rotation
	 * @param  int $times     Nombre de tour
	 */
	public function rotate($face, $direction, $times = 1) {
		// TODO : Rotating

		if($times > 1) {
			$this->rotate($face, $direction, $times - 1);
		}
	}

}
