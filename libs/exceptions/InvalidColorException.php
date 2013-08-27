<?php

namespace Rubs;

class InvalidColorException extends Exception {

	public function __construct() {
		parent::__construct('Invalid Color');
	}

}

?>
