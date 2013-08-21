<?php

class Matrix {

	public static function add(array $m1, array $m2) {
		if(empty($m1) || empty($m2)) {
			return [];
		}
		if(!self::_sameSized($m1, $m2)) {
			return false;
		}

		foreach ($m1 as $key => $value) {
			$m1[$key] += $m2[$key];
		}

		return $m1;
	}

	public static function multiply($m1, $m2) {
		if(!is_array($m1[0])) {
			$m1 = [$m1];
		}
		if(!is_array($m2[0])) {
			$m2 = [$m2];
		}

		$m1_rows = count($m1);
		$m1_cols = count($m1[0]);
		$m2_rows = count($m2);

		if($m1_cols != $m2_rows) {
			throw new Exception('Incompatible matrixes');
		}

		$m3 = [];
		for ($i = 0; $i < $m1_rows; $i++){
			for($j = 0; $j < $m1_cols; $j++){
				$m3[$i][$j] = 0;

				for($k = 0; $k < $m2_rows; $k++) {
					$m3[$i][$j] += $m1[$i][$k] * $m2[$k][$j];
				}
			}
		}

		return count($m3) == 1 ? current($m3) : $m3;
	}

	protected static function _sameSized($m1, $m2) {
		if(count($m1) != count($m2)) {
			return false;
		}
		if(is_array($m1) && count($m1[0]) != count($m2[0])) {
			return false;
		}

		// TODO moar tests

		return true;
	}

}
