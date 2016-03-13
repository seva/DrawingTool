<?php

namespace Seva\DrawingTool\IO;
use Seva\DrawingTool\Command\Canvas;

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

	function testPrintBorderHorizontal() {
		$this->writer->open('php://memory');
		$width = 3;
		$printEOL = function($width) {/* @var $this Writer */ $this->printBorderHorizontal($width);};
		$printEOL->call($this->writer, $width);
		$this->assertEquals(str_repeat(Writer::BORDER_HORIZONTAL, 1+$width+1), $this->getStreamContent($this->writer));
	}

	function testPrintBorderVertical() {
		$this->writer->open('php://memory');
		$printEOL = function() {/* @var $this Writer */ $this->printBorderVertical();};
		$printEOL->call($this->writer);
		$this->assertEquals(Writer::BORDER_VERTICAL, $this->getStreamContent($this->writer));
	}

	function testPrintEOL() {
		$this->writer->open('php://memory');
		$printEOL = function() {/* @var $this Writer */ $this->printEOL();};
		$printEOL->call($this->writer);
		$this->assertEquals(PHP_EOL, $this->getStreamContent($this->writer));
	}

	function testPrintColor() {
		$this->writer->open('php://memory');
		$printEOL = function($color) {/* @var $this Writer */ $this->printColor($color);};
		$color = 'X';
		$printEOL->call($this->writer, $color);
		$this->assertEquals($color, $this->getStreamContent($this->writer));
	}

	protected function getStreamContent(Writer $writer) {
		$getStreamContent = function() {/* @var $this Writer */
			$stream = $this->stream;
			rewind($stream);
			return stream_get_contents($stream);
		};
		return $getStreamContent->call($this->writer);
	}

}
