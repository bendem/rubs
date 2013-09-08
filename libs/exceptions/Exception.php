<?php

namespace Rubs\Exceptions;

\Rubs\Loader::uses('Rubs\Core\Logger');

class Exception extends \Exception {

	public function __construct($message) {
		$backtrace = debug_backtrace();
		Logger::error('In ' . $backtrace[1]['file'] . ' line ' . $backtrace[1]['line'] . ' : ' . $message);
		Logger::save();
		parent::__construct($message);
	}

}
