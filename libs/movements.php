<?php

trait Movements {

	/**
	 * Fait tourner une des faces du cube
	 * @param  int  $face      Numéro de la face (0-5)
	 * @param  bool $direction Sens de rotation (true : sens horaire, false : sens antihoraire)
	 * @param  int  $times     Nombre de tour
	 */
	public function rotate($face, $direction = true, $times = 1) {
		Logger::debug(sprintf('Rotating face %s, %sclockwise rotation, %s time%s...',
			$face, $direction ? '' : 'counter', $times, $times > 1 ? 's' : ''));
		// TODO : Rotating

		if($times > 1) {
			$this->rotate($face, $direction, $times - 1);
		}
	}

}
