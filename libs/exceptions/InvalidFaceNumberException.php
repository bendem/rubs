<?php

namespace Rubs\Exceptions;

\Rubs\Loader::uses('Rubs\Exceptions\Exception');

class InvalidFaceNumberException extends Exception {

	public function __construct() {
		parent::__construct('Invalid face number');
	}

}
