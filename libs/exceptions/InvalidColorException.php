<?php

namespace Rubs\Exceptions;

\Rubs\Loader::uses('Rubs\Exceptions\Exception');

class InvalidColorException extends Exception {

	public function __construct($msg = false) {
		parent::__construct($msg ? $msg : 'Invalid Color');
	}

}

?>
