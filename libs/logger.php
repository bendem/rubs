<?php

class Logger {

	/**
	 * Type de niveau de logging disponible
	 */
	const DEBUG = 1;
	const INFO = 10;
	const WARNING = 100;
	const ERROR = 1000;

	/**
	 * Log level
	 */
	public static $logLvl = self::DEBUG;

	/**
	 * Contient tous les logs à afficher
	 */
	protected static $logs = [];

	/**
	 * Ajoute un log de type debug
	 * @param  str $msg Contenu du log
	 * @param  str $title Titre du log (optionel)
	 */
	public static function debug($msg, $title = null) {
		self::_log($msg, $title, self::DEBUG);
	}

	/**
	 * Ajoute un log de type info
	 * @param  str $msg Contenu du log
	 * @param  str $title Titre du log (optionel)
	 */
	public static function info($msg, $title = null) {
		self::_log($msg, $title, self::INFO);
	}

	/**
	 * Ajoute un log de type warning
	 * @param  str $msg Contenu du log
	 * @param  str $title Titre du log (optionel)
	 */
	public static function warning($msg, $title = null) {
		self::_log($msg, $title, self::WARNING);
	}

	/**
	 * Ajoute un log de type error
	 * @param  str $msg Contenu du log
	 * @param  str $title Titre du log (optionel)
	 */
	public static function error($msg, $title = null) {
		self::_log($msg, $title, self::ERROR);
	}

	/**
	 * Affiche tous les logs
	 */
	public static function display() {
		foreach (self::$logs as $log) {
			if(self::$logLvl <= $log['type']) {
				echo self::_format($log['msg'], $log['title'], $log['type']);
			}
		}
	}

	/**
	 * Ajoute un log à l'objet
	 * @param  str $msg   Contenu du log
	 * @param  str $title Titre du log (optionel)
	 * @param  int $type  Type de log
	 */
	protected static function _log($msg, $title, $type) {
		self::$logs[] = ['msg' => $msg, 'title' => $title, 'type' => $type];
	}

	/**
	 * Formatte les logs pour l'affichage
	 * @param  str $msg   Contenu du log
	 * @param  str $title Titre du log (optionel)
	 * @param  int $type  Type de log
	 * @return str Code html
	 */
	protected static function _format($msg, $title, $type) {
		switch ($type) {
			case self::DEBUG:
				$type = 'debug';
				break;
			case self::INFO:
				$type = 'info';
				break;
			case self::WARNING:
				$type = 'warning';
				break;
			case self::ERROR:
				$type = 'danger';
				break;
		}

		$html = '<div class="callout callout-' . $type . '">';
		if($title !== null) {
			$html .= "<h4>$title</h4>";
		}
		$html .= "<p>$msg</p>";

		return $html . "</div>";
	}

}
