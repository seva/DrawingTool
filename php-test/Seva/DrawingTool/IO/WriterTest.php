<?php

namespace Seva\DrawingTool\IO;
use Seva\DrawingTool\Model\Drawing;

/**
 * Class ReaderTest
 * @package Seva\DrawingTool\IO
 * @covers \Seva\DrawingTool\IO\Reader
 */
class WriterTest extends \PHPUnit_Framework_TestCase
{
	/**
	 * @var Writer
	 */
	var $writer;

	function setUp() {
		$this->writer = new Writer();
	}
	function tearDown() {
		$this->writer = null;
	}

	/**
	 * @covers \Seva\DrawingTool\IO\Writer::open
	 */
	function testOpenSuccess() {
		$fileMock = 'php://memory';
		$this->writer->open($fileMock);
	}

	/**
	 * @covers \Seva\DrawingTool\IO\Writer::open
	 * @expectedException \LogicException
	 */
	function testOpenFailure() {
		$this->writer->open('/');
	}

	/**
	 * @covers \Seva\DrawingTool\IO\Writer::close
	 */
	function testClose() {
		$this->writer->open('php://memory');
		$isOpen = function() {/* @var $this Reader */
			return isset($this->stream);
		};
		$this->assertTrue($isOpen->call($this->writer));
		$this->writer->close();
		$this->assertFalse($isOpen->call($this->writer));
	}

	function testWriteDrawing() {
		$this->writer->open('php://memory');
		$drawing = new Drawing();
		$drawing->init(2, 2, ' ');
		$drawing->setColor(1, 2, 'X');
		$printEOL = function($drawing) {/* @var $this Writer */ $this->writeDrawing($drawing);};
		$printEOL->call($this->writer, $drawing);
		$expected = <<< EOS
----
|  |
|X |
----

EOS;
		$actual = $this->getStreamContent($this->writer);
		$expected = preg_replace('/[\n\r]+/', PHP_EOL, $expected); // avoid EOL mess
		$actual   = preg_replace('/[\n\r]+/', PHP_EOL, $actual);   // avoid EOL mess
		$this->assertEquals($expected, $actual);
	}

	function testPrintBorderHorizontal() {
		$this->writer->open('php://memory');
		$width = 3;
		$printEOL = function($width) {/* @var $this Writer */ $this->printBorderHorizontal($width);};
		$printEOL->call($this->writer, $width);
		$this->assertEquals(str_repeat(Writer::BORDER_HORIZONTAL, 1+$width+1), $this->getStreamContent());
	}

	function testPrintBorderVertical() {
		$this->writer->open('php://memory');
		$printEOL = function() {/* @var $this Writer */ $this->printBorderVertical();};
		$printEOL->call($this->writer);
		$this->assertEquals(Writer::BORDER_VERTICAL, $this->getStreamContent());
	}

	function testPrintEOL() {
		$this->writer->open('php://memory');
		$printEOL = function() {/* @var $this Writer */ $this->printEOL();};
		$printEOL->call($this->writer);
		$this->assertEquals(PHP_EOL, $this->getStreamContent());
	}

	function testPrintColor() {
		$this->writer->open('php://memory');
		$printEOL = function($color) {/* @var $this Writer */ $this->printColor($color);};
		$color = 'X';
		$printEOL->call($this->writer, $color);
		$this->assertEquals($color, $this->getStreamContent());
	}

	protected function getStreamContent() {
		$getStreamContent = function() {/* @var $this Writer */
			$stream = $this->stream;
			rewind($stream);
			return stream_get_contents($stream);
		};
		return $getStreamContent->call($this->writer);
	}

}
