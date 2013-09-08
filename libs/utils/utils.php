<?php

namespace Rubs\Utils;

class Utils {

	/**
	 * Inverse deux variables
	 * @param  mixed $a
	 * @param  mixed $b
	 */
	public static function reverse(&$a, &$b) {
		$temp = $a;
		$a = $b;
		$b = $temp;
	}

	/**
	 * Réorganise un tableau en se basant sur ``array_values``
	 * @param  array   $array     Tableau à réorganiser
	 * @param  boolean $recursive Réorganiser le tableau de manière récursive ?
	 * @return array
	 */
	public static function array_reorder(array $array, $recursive = true) {
		if (empty($array)) {
			return $array;
		}

		foreach ($array as $k => $v) {
			if($recursive && is_array($v)) {
				$array[$k] = self::array_reorder($v);
			}
		}

		return array_values($array);
	}

	/**
	 * Affiche un tableau 2d sous forme de tableau html
	 * @param  array  $array Tableau à afficher
	 */
	public static function array_display_2d(array $array) {
		if (empty($array) || empty($array[0]) || !is_array($array[0])) {
			return;
		}

		echo '<table style="border-collapse: collapse;">' . "\n";
		foreach ($array as $k => $row) {
			echo "\t<tr>\n";
			foreach ($row as $v) {
				if (is_array($v)) {
					$v = self::array_string($v);
				}
				echo "\t\t<td style=\"border: 1px solid black; padding: 3px;\">$v</td>\n";
			}
			echo "\t</tr>\n";
		}
		echo "</table>\n";
	}

	/**
	 * Retourne le contenu d'un tableau sous forme de chaine de caractères
	 * @param  array   $array Tableau à afficher
	 * @param  boolean $keys  Afficher les clés dans le tableau ?
	 * @return string
	 */
	public static function array_string(array $array, $keys = false) {
		$str = '[';
		foreach ($array as $k => $v) {
			if (is_array($v)) {
				$v = self::array_string($v);
			}
			if ($keys) {
				$str .= "$k => ";
			}
			$str .= "$v, ";
		}
		$str = substr($str, 0, -2);
		$str .= ']';

		return $str;
	}

}
