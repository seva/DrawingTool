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
	 * @covers \Seva\DrawingTool\IO\Reader::close
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

}
