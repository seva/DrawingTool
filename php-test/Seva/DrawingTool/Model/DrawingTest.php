<?php

namespace Seva\DrawingTool\Model;
/**
 * Class DrawingTest
 * @package Seva\DrawingTool\Model
 * @covers \Seva\DrawingTool\Model\Drawing
 */
class DrawingTest extends \PHPUnit_Framework_TestCase
{
	/**
	 * @var Drawing
	 */
	var $drawing;

	function setUp() {
		$this->drawing = new Drawing();
	}

	function tearDown() {
		$this->drawing = null;
	}

	/**
	 * @covers \Seva\DrawingTool\Model\Drawing::init
	 * @covers \Seva\DrawingTool\Model\Drawing::getWidth
	 * @covers \Seva\DrawingTool\Model\Drawing::getHeight
	 */
	function testInitWidthHeight() {
		$color = '@';
		$dim = 10;
		$this->drawing->init($dim, $dim, $color);
		$this->assertEquals($dim, $this->drawing->getWidth());
		$this->assertEquals($dim, $this->drawing->getHeight());
	}

	/**
	 * @covers \Seva\DrawingTool\Model\Drawing::isValid
	 */
	function testValid() {
		$dim = 5;
		$this->drawing->init($dim, $dim, 'x');
		$isValid = function($x, $y) {
			/* @var $this Drawing */
			return $this->isValid($x, $y);
		};
		$this->assertTrue($isValid->call($this->drawing, 1, 1));
		$this->assertTrue($isValid->call($this->drawing, 1, $dim));
		$this->assertTrue($isValid->call($this->drawing, $dim, 1));
		$this->assertTrue($isValid->call($this->drawing, $dim, $dim));
		$this->assertFalse($isValid->call($this->drawing, 1,0));
		$this->assertFalse($isValid->call($this->drawing, 1,$dim+1));
		$this->assertFalse($isValid->call($this->drawing, 0, 1));
		$this->assertFalse($isValid->call($this->drawing, $dim+1, 1));
	}
	function testColor() {
		$empty = 'O';
		$full  = 'X';
		$this->drawing->init(2, 2, $empty);
		$this->drawing->setColor(1, 2, $full);
		$this->assertEquals($full, $this->drawing->getColor(1, 2));
		$this->assertEquals($empty, $this->drawing->getColor(2, 1));
		$this->drawing->setColor(3,3,$full);
		$this->assertEmpty($this->drawing->getColor(3,3));
	}
}
