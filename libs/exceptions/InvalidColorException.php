<?php

namespace Rubs\Exceptions;

\Rubs\Loader::uses('Rubs\Exceptions\Exception');

class InvalidColorException extends Exception {

	public function __construct() {
		parent::__construct('Invalid Color');
	}

}

?>
