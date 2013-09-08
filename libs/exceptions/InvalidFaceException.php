<?php

namespace Rubs\Exceptions;

class InvalidFaceException extends Exception {

	public function __construct() {
		parent::__construct('Invalid Cube face');
	}

}

?>
