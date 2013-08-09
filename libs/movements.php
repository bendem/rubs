<?php

namespace Rubs;

/**
 * Code gérant les mouvements des faces du cube
 */
trait Movements {

	/**
	 * Fait tourner une des faces du cube
	 * @param  int  $face      Numéro de la face (0-5)
	 * @param  bool $direction Sens de rotation (true : sens horaire, false : sens antihoraire)
	 * @param  int  $times     Nombre de tour(s)
	 *
	 * @todo   Rotating
	 */
	public function rotate($face, $direction = true, $times = 1) {
		Logger::debug(sprintf('Rotating face %s, %sclockwise rotation, %s time%s...',
			$face, $direction ? '' : 'counter', $times, $times > 1 ? 's' : ''));

		// Rotate ``$face``


		// Rotate each ``adjacentFaces``
		$adj = $this->adjacentsFaces($face);

		if($times > 1) {
			$this->rotate($face, $direction, $times - 1);
		}
	}

}
