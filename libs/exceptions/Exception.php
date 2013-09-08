<?php

namespace Rubs\Exceptions;

\Rubs\Loader::uses('Rubs\Core\Logger');

class Exception extends \Exception {

	public function __construct($message) {
		$backtrace = debug_backtrace();
		\Rubs\Core\Logger::error('In ' . $backtrace[1]['file'] . ' line ' . $backtrace[1]['line'] . ' : ' . $message);
		\Rubs\Core\Logger::save();
		parent::__construct($message);
	}

}
