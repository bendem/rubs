<?php

namespace Rubs;

/**
 * Système de logging
 * @author bendem <bendembd@gmail.com>
 */
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
	public static $logLvl = self::INFO;

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
			echo self::_format($log['msg'], $log['title'], $log['type'], self::$logLvl > $log['type']);
		}
	}

	public static function lvlToStr($type = null) {
		if($type === null) {
			$type = self::$logLvl;
		}

		switch ($type) {
			case self::DEBUG:
				return 'debug';
			case self::INFO:
				return 'info';
			case self::WARNING:
				return 'warning';
			case self::ERROR:
				return 'error';
		}
	}

	public static function save() {
		$i = 0;
		foreach (self::$logs as $log) {
			if ($log['type'] >= self::$logLvl) {
				$data[$i] = '[' . strtoupper(self::lvlToStr($log['type'])) . '] ';
				if ($log['title']) {
					$data[$i] .= $log['title'] . ', ';
				}
				if (!preg_match('#[\.!?]$#', $log['msg']) && $log['type'] >= self::WARNING) {
					$log['msg'] .= '...';
				}
				$data[$i] .= $log['msg'];
				$i++;
			}
		}

		$date = date('Y-m-d_H-i-s');
		$header = "================================\n";
		$header .= "  Logs du $date\n";
		$header .= "================================\n\n";
		file_put_contents(LOG_DIR . DS . 'logs-' . $date . '.txt', $header . implode("\n", $data));
		self::_clearLogs();
	}

	/**
	 * Ajoute un log à l'objet
	 * @param str $msg   Contenu du log
	 * @param str $title Titre du log (optionel)
	 * @param int $type  Type de log
	 */
	protected static function _log($msg, $title, $type) {
		self::$logs[] = ['msg' => $msg, 'title' => $title, 'type' => $type];
	}

	/**
	 * Formate les logs pour l'affichage
	 * @param  str  $msg    Contenu du log
	 * @param  str  $title  Titre du log (optionel)
	 * @param  int  $type   Type de log
	 * @param  bool $hidden Masque le contenu par défaut
	 * @return str Code html
	 */
	protected static function _format($msg, $title, $type, $hidden) {
		$type = self::lvlToStr($type);

		$html = '<div class="callout callout-' . $type . '" style="display:';
		$html .= ($hidden ? 'none' : 'block') . '">';
		if ($title !== null) {
			$html .= "<h4>$title</h4>";
		}
		$html .= '<span class="close">x</span>';
		$html .= "<p>$msg</p>";

		return $html . "</div>";
	}

	protected static function _clearLogs($max = 5) {
		$exclude = array('.', '..');
		$logs = array_diff(scandir(LOG_DIR), $exclude);
		sort($logs);
		for ($i = 0; $i < count($logs) - $max; $i++) {
			unlink(LOG_DIR . DS . $logs[$i]);
		}
	}

}
