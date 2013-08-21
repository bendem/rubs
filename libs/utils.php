<?php

namespace Rubs;

class Utils {

	public static function reverse(&$a, &$b) {
		$temp = $a;
		$a = $b;
		$b = $temp;
	}

	public static function array_reorder(array $array, $recursive = true) {
		if(empty($array)) {
			return $array;
		}

		foreach ($array as $k => $v) {
			if($recursive && is_array($v)) {
				$array[$k] = self::array_reorder($v);
			}
		}

		return array_values($array);
	}

	public static function array_display_2d(array $array) {
		if(empty($array) || empty($array[0]) || !is_array($array[0])) {
			return;
		}

		echo "<table>";
		foreach ($array as $k => $row) {
			echo "<tr>";
			foreach ($row as $v) {
				if(is_array($v)) {
					$v = self::array_string($v);
				}
				echo "<td>$v</td>";
			}
			echo "</tr>";
		}
		echo "</table>";
	}

	public static function array_string(array $array, $keys = false) {
		$str = '[';
		foreach ($array as $k => $v) {
			if(is_array($v)) {
				$v = self::array_string($v);
			}
			if($keys) {
				$str .= "$k => ";
			}
			$str .= "$v, ";
		}
		$str = substr($str, 0, -2);
		$str .= ']';

		return $str;
	}

}
