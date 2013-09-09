<?php

Rubs\loader::uses('Rubs\Core\Logger');

class LoggerTest extends PHPUnit_Framework_TestCase {

	public function setUp() {
		if(!is_dir(TMP)) {
			mkdir(TMP, 0755);
		}
	}

	public function tearDown() {
		delTree(TMP);
	}

	public function testLogDirCreation() {
		Rubs\Core\Logger::info('test');
		Rubs\Core\Logger::save(TMP);

		$this->assertTrue(is_dir(TMP));
		$this->assertEquals(3, count(scandir(TMP)));
	}

	public function testLogFileNameCreation() {
		$this->markTestIncomplete('Test not implemented');
	}

	public function testLogFileCreation() {
		Rubs\Core\Logger::info('test');
		Rubs\Core\Logger::save(TMP);

		$this->assertEquals(3, count(scandir(TMP)));
	}

	public function testLogClearing() {
		$this->markTestIncomplete('Test not implemented');
	}

}
