<?php

namespace Rubs;

class InvalidColorException extends Exception {

	public function __construct($msg = 'Invalid Color') {
		parent::__construct($msg);
	}

}

?>
