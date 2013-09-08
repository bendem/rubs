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

	public function testGetCube() {
		$cube = new Rubs\Cube(true);

		// Accès à une valeur protégée d'une classe
		$reflectedCube = new ReflectionClass('Rubs\Cube');
		$p = $reflectedCube->getProperty("cube");
		$p->setAccessible(true);
		$generatedCube = $p->getValue($cube);

		$this->assertEquals($generatedCube, $cube->getCube());
	}

	/**
	 * @depends testGetCube
	 */
	public function testCubeGeneration() {
		$cube = new Rubs\Cube(true);
		$cubeContent = $cube->getCube();
		$this->assertTrue($cube->security->isValidCube($cubeContent));
		$this->assertEquals(6, count($cubeContent));

		$colorsCount = [];
		foreach ($cubeContent as $face) {
			$this->assertEquals(3, count($face));

			foreach ($face as $line) {
				$this->assertEquals(3, count($line));

				foreach ($line as $block) {
					if(isset($colorsCount[$block])) {
						$colorsCount[$block]++;
					} else {
						$colorsCount[$block] = 1;
					}
				}
			}
		}

		$colors = [];
		foreach ($cube->colors as $color) {
			$colors[$color] = 9;
		}

		ksort($colors);
		ksort($colorsCount);

		$this->assertEquals($colors, $colorsCount);
	}

}
