<?php

namespace Rubs\Exceptions;

\Rubs\Loader::uses('Rubs\Exceptions\Exception');

class InvalidLineException extends Exception {

	public function __construct() {
		parent::__construct('Invalid Cube line');
	}

}
