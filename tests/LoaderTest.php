<?php

class LoaderTest extends PHPUnit_Framework_TestCase {

	public function setUp() {
		$this->tmpFolder = APP . DS . 'libs' . DS . 'tmp';

		if(is_dir($this->tmpFolder)) {
			return;
		}

		if(!mkdir($this->tmpFolder, 0775) || !is_dir($this->tmpFolder)) {
			$this->markTestSkipped('Dossier temporaire non créé');
		}
	}

	public function tearDown() {
		$this->_delTree($this->tmpFolder);
	}

	protected function _delTree($dir) {
		$files = array_diff(scandir($dir), array('.','..'));
		foreach ($files as $file) {
			(is_dir($dir . DS . $file)) ? $this->delTree($dir . DS . $file) : unlink($dir . DS . $file);
		}
		return rmdir($dir);
	}

	public function testLoading() {
		file_put_contents(
			$this->tmpFolder . DS . 'test1.php',
			'<?php namespace Rubs\Tmp; function yolo() {} ?>'
		);

		Rubs\Loader::uses('Rubs\Tmp\Test1');
		$this->assertTrue(function_exists('Rubs\Tmp\yolo'));
	}

	public function testCascadingLoading() {
	}

}
