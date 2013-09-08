<?php

require_once(APP . DS . 'libs' . DS . 'cube.php');

class CubeTest extends PHPUnit_Framework_TestCase {

	public function setUp(){ }
	public function tearDown(){ }

	public function testOppositeFacesCantBeAdjacent() {
		$cube = new Rubs\Cube(true);
		for ($i = 0; $i < 5; $i++) {
			$error = false;
			try {
				$cube->security->canBeAdjacent($i, $cube->getOppositeFace($i));
			} catch (\Rubs\Exceptions\CantBeAdjacentException $e) {
				$error = true;
			}
			$this->assertTrue($error);
		}
	}

	public function testSkipRenderingTrue() {
		ob_start();
		$cube = new Rubs\Cube(true);
		$cube->__destruct();
		$generatedContent = ob_get_clean();
		$this->assertEquals('', $generatedContent);
	}

	public function testSkipRenderingFalse() {
		ob_start();
		$cube = new Rubs\Cube();
		$cube->__destruct();
		$generatedContent = ob_get_clean();
		$this->assertContains('<!DOCTYPE html>', $generatedContent);
	}

	public function testCubeGeneration() {
		$cube = new Rubs\Cube(true);
		$this->assertTrue($this->security->isValidCube($cube->getCube()));
	}

}
