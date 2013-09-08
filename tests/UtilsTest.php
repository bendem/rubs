<?php

Rubs\loader::uses('Rubs\Utils\Utils');

class UtilsTest extends PHPUnit_Framework_TestCase {

	public function setUp() {}
	public function tearDown() {}

	public function testReverse() {
		$a = 3;
		$b = 2;
		Rubs\Utils\Utils::reverse($a, $b);
		$this->assertEquals(2, $a);
		$this->assertEquals(3, $b);
	}

}
