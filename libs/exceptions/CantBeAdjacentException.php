<?php

namespace Rubs\Exceptions;

\Rubs\Loader::uses('Rubs\Exceptions\Exception');

class CantBeAdjacentException extends Exception {

	public function __construct($face1, $face2) {
		parent::__construct("Faces $face1 and $face2 can't be adjacent");
	}

}

?>
