<?php

namespace Rubs;

class InvalidLineException extends Exception {

	public function __construct() {
		parent::__construct('Invalid Cube line');
	}

}
