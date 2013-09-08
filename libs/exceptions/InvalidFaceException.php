<?php

namespace Rubs\Exceptions;

\Rubs\Loader::uses('Rubs\Exceptions\Exception');

class InvalidFaceException extends Exception {

	public function __construct() {
		parent::__construct('Invalid Cube face');
	}

}

?>
