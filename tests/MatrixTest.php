<?php

Rubs\loader::uses('Rubs\Utils\Matrix');

class MatrixTest extends PHPUnit_Framework_TestCase {

	public function setUp() {}
	public function tearDown() {}

	public function argumentsToFailMultiply() {
		$badArguments = [];
		for ($i = 0; $i < 5; $i++) {
			$rand1 = $this->generateRandomMatrix(rand(1, 5), rand(1, 5));
			$rand2 = $this->generateRandomMatrix(rand(1, 5), rand(1, 5));
			if(count($rand1) != count($rand2[0])) {
				$badArguments[$i][] = $rand1;
				$badArguments[$i][] = $rand2;
			}
		}

		return $badArguments;
	}

	public function generateRandomMatrix($l, $c) {
		$m = [];
		for ($i = 0; $i < $c; $i++) {
			for ($j = 0; $j < $l; $j++) {
				$m[$i][$j] = rand(0, 5);
			}
		}

		return $m;
	}

	public function addArguments() {
		return [
			[
				[3, 5],
				[1, 2],
				[2, 3]
			],
			[
				[[3, 7, -1], [5, 9, -1]],
				[[1, 3, -1], [2, 5, -1]],
				[[2, 4, 0],  [3, 4, 0]]
			],
			[
				false,
				[1, 2, 3],
				[2, 3]
			],
		];
	}

	public function multiplyArguments() {
		return [
			[
				[3, 6],
				[[3]],
				[[1, 2]]
			],
			[
				[[3, 6, 9], [4, 8, 12]],
				[[3], [4]],
				[[1, 2, 3]]
			]
		];
	}

	/**
	 * @dataProvider addArguments
	 */
	public function testAdd($r, $m1, $m2) {
		$this->assertEquals($r, Rubs\Utils\Matrix::add($m1, $m2));
	}

	/**
	 * @dataProvider argumentsToFailMultiply
	 */
	public function testMultiplyArgumentsCheck($m1, $m2) {
		$error = false;
		try {
			Rubs\Utils\Matrix::multiply([2, 2], [2, 2]);
		} catch(Exception $e) {
			$error = true;
		}

		$this->assertTrue($error);
	}

	/**
	 * @dataProvider multiplyArguments
	 */
	public function testMultiplyResult($r, $m1, $m2) {
		$this->assertEquals($r, Rubs\Utils\Matrix::multiply($m1, $m2));
	}

}
