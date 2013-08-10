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

		// Inutile de faire plusieurs tours...
		if($times > 3) {
			$times %= 4;
		}

		// On inverse la direction en tournant 3x dans le sens par défaut
		if(!$direction) {
			$times = 4 - $times;
		}

		// Rotate ``$face``
		for($i = 0; $i < 3; $i++) {
			for ($j = 0; $j < 3; $j++) {
				if($i == 0) {
					Utils::reverse($this->cube[$face][$i][$j],
						$this->cube[$face][$j][$i]);
				}
			}
		}

		// Rotate each ``adjacentFaces``
		$adj = $this->adjacentsFaces($face);
		foreach ($adj as $face) {
			//
		}

		if($times > 1) {
			$this->rotate($face, true, $times - 1);
		}
	}

}
