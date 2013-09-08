<?php

namespace Rubs\Core;

\Rubs\Loader::uses('Rubs\Core\Getter');
\Rubs\Loader::uses('Rubs\Core\Logger');
\Rubs\Loader::uses('Rubs\Core\Setter');
\Rubs\Loader::uses('Rubs\Utils\Matrix');
\Rubs\Loader::uses('Rubs\Utils\Utils');

/**
 * Code gérant les mouvements des faces du cube
 */
trait Movements {

	/**
	 * Patterns utilisés pour la rotation d'un face du cube
	 *
	 * @var array
	 */
	protected $_rotationPatterns = [];

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
		if ($times > 3) {
			$times %= 4;
		}

		// On inverse la direction en tournant 3x dans le sens par défaut
		if ($clockWise) {
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
		$newFace = \Rubs\Utils\Utils::array_reorder($newFace);

		// On sauve la nouvelle face
		$this->setFace($face, $newFace);

		// TODO : faire tourner les lignes adjacentes
		$adjacentFaces = $this->getRoundedAdjacentsFaces($face);
		foreach ($adjacentFaces as $cur => $adj) {
			// TODO : Vérifier si on ne passe pas une ligne dans une colonne...
			$info = $this->getAdjacentLine($face, $adj);
			var_dump($info);
			// $this->setLine($adjacentFaces[($cur + 1) % 6], ???,  $lineToMove);
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
		if(isset($this->_rotationPatterns[$angle])) {
			return $this->_rotationPatterns[$angle];
		}

		Logger::debug('Generating ' . $angle . '° rotation pattern...');

		$rotationPattern = [];
		$rotationMatrix = [
			[(int)cos(deg2rad($angle)), (int)sin(deg2rad($angle))],
			[(int)-sin(deg2rad($angle)), (int)cos(deg2rad($angle))]
		];
		for ($i = 0; $i < 3; $i++) {
			for ($j = 0; $j < 3; $j++) {
				$coord = [$i, $j];
				// Centrage des coordonées
				$coord = \Rubs\Utils\Matrix::add($coord, [-1, -1]);
				// Rotation
				$coord = \Rubs\Utils\Matrix::multiply($coord, $rotationMatrix);
				// Décentrage
				$coord = \Rubs\Utils\Matrix::add($coord, [1, 1]);

				$rotationPattern[$i][$j] = $coord;
			}
		}

		$this->_rotationPatterns[$angle] = $rotationPattern;

		return $rotationPattern;
	}

}
