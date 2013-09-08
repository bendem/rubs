<?php

Rubs\loader::uses('Rubs\Core\Logger');

class LoggerTest extends PHPUnit_Framework_TestCase {

	public function setUp() {}
	public function tearDown() {}

	public function testLogDirCreation() {
		Rubs\Core\Logger::info('test');
		Rubs\Core\Logger::save();

		$this->assertTrue(is_dir(APP . DS . 'logs'));
		$this->assertGreaterThanOrEqual(3, count(scandir(APP . DS . 'logs')));
	}

	public function testLogFileNameCreation() {
		$this->markTestIncomplete();
	}

	public function testLogFileCreation() {
		$this->markTestIncomplete();
	}

}
