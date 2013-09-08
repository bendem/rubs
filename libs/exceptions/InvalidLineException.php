<?php

namespace Rubs\Exceptions;

class InvalidLineException extends Exception {

	public function __construct() {
		parent::__construct('Invalid Cube line');
	}

}
