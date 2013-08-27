<?php

namespace Rubs;

class InvalidFaceNumberException extends Exception {

	public function __construct() {
		parent::__construct('Invalid face number');
	}

}
