<?php

namespace Rubs;

class Loader {

	protected static $_loaded = [];

	public static function uses($name, $wildcard = false) {
		$pathinfo = explode('\\', strtolower($name));

		// Retrait de namespace absolu
		if($pathinfo[0] === '') {
			array_shift($pathinfo);
		}

		// Préfixe du dossier libs
		if($pathinfo[0] === 'rubs') {
			$pathinfo[0] = APP . DS . 'libs';
		} else {
			array_unshift($pathinfo, APP . DS . 'libs');
		}


		$path = implode(DS, $pathinfo) . '.php';

		return $wildcard ? self::_loadWildPath($path) : self::_loadFile($path);
	}

	protected static function _loadFile($path) {
		$path = self::_getCameledCasePath($path);
		if(in_array($path, self::$_loaded)) {
			return false;
		}

		require $path;
		self::$_loaded[] = $path;

		return true;
	}

	protected static function _loadWildPath($path) {
		$glob = glob($path);
		if(!$glob) {
			return;
		}

		$ret = true;

		foreach ($glob as $file) {
			$ret = self::_loadFile($file) && $ret;
		}

		return $ret;
	}

	protected static function _getCameledCasePath($path) {
		$path = str_replace(APP, '', $path);
		$pathinfo = explode(DS, $path);
		if($pathinfo[0] === '') {
			array_shift($pathinfo);
		}
		$path = APP;
		foreach (array_slice($pathinfo, 0, -1) as $v) {
			$path .= DS . self::_searchRealName($path, $v);
		}

		$filename = array_pop($pathinfo);
		$path .= DS . self::_searchRealName($path, $filename);

		return $path;
	}

	protected static function _searchRealName($path, $toAdd) {
		$files = array_diff(scandir($path), ['.', '..']);
		foreach ($files as $file) {
			if(strtolower($file) === strtolower($toAdd)) {
				return $file;
			}
		}
	}

}
