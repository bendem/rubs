<?php

namespace Rubs\Utils;

class Matrix {

	public static function add(array $matrix1, array $matrix2) {
		if (empty($matrix1) || empty($matrix2)) {
			return [];
		}
		if (!self::_sameSized($matrix1, $matrix2)) {
			return false;
		}

		foreach ($matrix1 as $l => $v) {
			if(is_array($matrix1[$l])) {
				foreach ($matrix1[$l] as $c => $value) {
					$matrix1[$l][$c] += $matrix2[$l][$c];
				}
			} else {
				$matrix1[$l] += $matrix2[$l];
			}
		}

		return $matrix1;
	}

	public static function multiply($matrix1, $matrix2) {
		if (!is_array($matrix1[0])) {
			foreach ($matrix1 as $k => $v) {
				$matrix1[$k] = [$v];
			}
		}
		if (!is_array($matrix2[0])) {
			foreach ($matrix2 as $k => $v) {
				$matrix2[$k] = [$v];
			}
		}

		$matrix1_rows = count($matrix1);
		$matrix1_cols = count($matrix1[0]);
		$matrix2_rows = count($matrix2);
		$matrix2_cols = count($matrix2[0]);

		if ($matrix1_cols != $matrix2_rows) {
			throw new \Exception('Incompatible matrixes');
		}

		$matrix3 = [];
		for ($i = 0; $i < $matrix1_rows; $i++){
			for ($j = 0; $j < $matrix2_cols; $j++){
				$matrix3[$i][$j] = 0;

				for ($k = 0; $k < $matrix1_cols; $k++) {
					$matrix3[$i][$j] += $matrix1[$i][$k] * $matrix2[$k][$j];
				}
			}
		}

		// Si la matrice ne contient qu'une ligne, on retourne juste la ligne
		return count($matrix3) == 1 ? current($matrix3) : $matrix3;
	}

	protected static function _sameSized($matrix1, $matrix2) {
		if (count($matrix1) != count($matrix2)) {
			return false;
		}
		if (is_array($matrix1) && count($matrix1[0]) != count($matrix2[0])) {
			return false;
		}

		// TODO moar tests

		return true;
	}

}
