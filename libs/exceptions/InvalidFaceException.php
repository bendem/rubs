<?php

namespace Rubs;

class InvalidFaceException extends Exception {

	function __construct() {
		parent::__construct('Invalid Cube face');
	}
}

?>
