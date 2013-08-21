<?php

namespace Rubs;

/**
 * Code gérant les mouvements des faces du cube
 */
trait Movements {

	/**
	 * Pattern utilisé pour la rotation d'une face
	 * Le cube situé en (0, 0) ira en (0, 2) et ainsi de suite
	 *
	 * @var array
	 */
	protected $_rotatingPattern = [
		[ [0, 2], [1, 2], [2, 2] ],
		[ [0, 1], [1, 1], [2, 1] ],
		[ [0, 0], [1, 0], [2, 0] ]
	];

	/**
	 * Fait tourner une des faces du cube
	 * @param  int  $face      Numéro de la face (0-5)
	 * @param  bool $direction Sens de rotation (true : sens horaire, false : sens antihoraire)
	 * @param  int  $times     Nombre de tour(s)
	 *
	 * @todo   Rotating each adjacent line
	 */
	public function rotate($face, $clockWise = true, $times = 1) {
		Logger::debug(sprintf('Rotating face %s, %sclockwise rotation, %s time%s...',
			$face, $clockWise ? '' : 'counter', $times, $times > 1 ? 's' : ''));

		// Inutile de faire plusieurs tours...
		if($times > 3) {
			$times %= 4;
		}

		// On inverse la direction en tournant 3x dans le sens par défaut
		if($clockWise) {
			$times = 4 - $times;
		}

		$pattern = $this->_generateRotationPattern($times * 90);

		// Rotate ``$face``
		$newFace = [];
		foreach ($pattern as $rowId => $row) {
			foreach ($row as $colId => $moveTo) {
				$newFace[$moveTo[0]][$moveTo[1]] = $this->cube[$face][$rowId][$colId];
			}
		}
		// Le tableau n'est pas générer dans l'ordre,
		// du coup on le réorganise
		$newFace = Utils::array_reorder($newFace);

		// On n'oublie de vérifier que la face est valide
		// TODO créer des setter qui vérifie automatiquement
		$this->security->is_face($newFace);
		$this->cube[$face] = $newFace;

		// TODO : Rotate each adjacent line
		$adjecentFaces = $this->adjacentsFaces($face);
		foreach ($adjecentFaces as $adjecentFace) {
			//
		}
	}

	/**
	 * Génère le pattern de rotation de face
	 *
	 * Le pattern est généré en utilisant le principe de rotation
	 * de coordonées via les matrices
	 * @param  int $angle Angle de rotation
	 * @return array
	 */
	protected function _generateRotationPattern($angle) {
		$rotationPattern = [];
		$rotationMatrix = [
			[(int)cos(deg2rad($angle)), (int)sin(deg2rad($angle))],
			[(int)-sin(deg2rad($angle)), (int)cos(deg2rad($angle))]
		];
		for ($i = 0; $i < 3; $i++) {
			for ($j = 0; $j < 3; $j++) {
				$coord = [$i, $j];
				// Centrage des coordonées
				$coord = \Matrix::add($coord, [-1, -1]);
				// Rotation
				$coord = \Matrix::multiply($coord, $rotationMatrix);
				// Décentrage
				$coord = \Matrix::add($coord, [1, 1]);

				$rotationPattern[$i][$j] = $coord;
			}
		}

		return $rotationPattern;
	}

}
