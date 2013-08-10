<?php

namespace Rubs;

class Utils {

	public static function reverse(&$a, &$b) {
		$temp = $a;
		$a = $b;
		$b = $temp;
	}

}
