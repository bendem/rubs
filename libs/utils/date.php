<?php

namespace Rubs\Utils;

class Date {

	public function __construct($time = 'now') {
		$this->timeStr = $time;
		$this->time = strtotime($time);

		if(!$this->time) {
			throw new InvalidTimeException();
		}

		return true;
	}

	public function format($format) {
		if($this->timeStr == 'now' && preg_match('#[^\\\\]u#', $format)) {
			$us = current(explode(' ', microtime()));
			$ms = $this->fillWithZero((int) ($us * 1000), 3);
			$format = preg_replace('#([^\\\\])u#', '$1\\\\' . $ms, $format);
		}


		return date($format, $this->time);
	}

	public function fillWithZero($number, $min_size) {
		$number = (string) $number;
		for ($i = strlen($number); $i < $min_size; $i++) {
			$number = '0' . $number;
		}

		return $number;
	}

}
