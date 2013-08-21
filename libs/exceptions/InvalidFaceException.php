<?php

namespace Rubs;

class InvalidFaceException extends Exception {

	public function __construct() {
		parent::__construct('Invalid Cube face');
	}

}

?>
