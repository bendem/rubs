<?php

Rubs\loader::uses('Rubs\Core\Security');

class SecurityTest extends PHPUnit_Framework_TestCase {

	public function setUp() {}
	public function tearDown() {}

	public function testColorNumberCheckFail() {
		$error = false;
		$colors = ['a', 'b'];
		$cube = new Rubs\Cube(true);

		try {
			$security = new Rubs\Core\Security($colors, $cube);
		} catch(Rubs\Exceptions\InvalidColorException $e) {
			$error = true;
			$errorMsg = $e->getMessage();
		}

		$this->assertTrue($error);
		$this->assertEquals('6 Couleurs... Pas plus pas moins', $errorMsg);
	}

	public function testColorDifferenceCheckFail() {
		$error = false;
		$colors = ['a', 'b', 'c', 'a', 'b', 'c'];
		$cube = new Rubs\Cube(true);

		try {
			$security = new Rubs\Core\Security($colors, $cube);
		} catch(Rubs\Exceptions\InvalidColorException $e) {
			$error = true;
			$errorMsg = $e->getMessage();
		}

		$this->assertTrue($error);
		$this->assertEquals('Les 6 couleurs doivent être différentes', $errorMsg);
	}

	public function testColorCheckSuccess() {
		$error = false;
		$colors = ['a', 'b', 'c', 'd', 'e', 'f'];
		$cube = new Rubs\Cube(true);

		try {
			$security = new Rubs\Core\Security($colors, $cube);
		} catch(Rubs\Exceptions\InvalidColorException $e) {
			$error = true;
		}

		$this->assertFalse($error);
	}

}
