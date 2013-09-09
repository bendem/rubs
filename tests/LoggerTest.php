<?php

Rubs\loader::uses('Rubs\Core\Logger');

class LoggerTest extends PHPUnit_Framework_TestCase {

	public function setUp() {}
	public function tearDown() {}

	public function testLogDirCreation() {
		Rubs\Core\Logger::info('test');
		Rubs\Core\Logger::save(TMP);

		$this->assertTrue(is_dir(TMP));
		$this->assertEquals(3, count(scandir(TMP)));
	}

	public function testLogFileNameCreation() {
		$this->markTestIncomplete();
	}

	public function testLogFileCreation() {
		$this->markTestIncomplete();
	}

}
