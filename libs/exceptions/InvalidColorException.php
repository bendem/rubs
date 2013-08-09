<?php

namespace Rubs;

class InvalidColorException extends Exception {

	function __construct($msg = 'Invalid Color') {
		parent::__construct($msg);
	}
}

?>
