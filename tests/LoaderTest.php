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
		delTree($this->tmpFolder);
	}

	public function testLoading() {
		file_put_contents(
			$this->tmpFolder . DS . 'test1.php',
			'<?php namespace Rubs\Tmp; class Test1 {} ?>'
		);

		Rubs\Loader::uses('Rubs\Tmp\Test1');
		$this->assertTrue(class_exists('Rubs\Tmp\Test1'));
	}

	public function testCascadingLoading() {
		file_put_contents(
			$this->tmpFolder . DS . 'test2.php',
			"<?php namespace Rubs\Tmp; \\Rubs\\Loader::uses('Rubs\\Tmp\\Test1'); class Test2 {} ?>"
		);
		file_put_contents(
			$this->tmpFolder . DS . 'test1.php',
			"<?php namespace Rubs\Tmp; class Test1 {} ?>"
		);

		Rubs\Loader::uses('Rubs\Tmp\Test2');
		$this->assertTrue(class_exists('Rubs\Tmp\Test1'));
	}

}
