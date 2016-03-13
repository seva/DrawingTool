<?php

namespace Seva\DrawingTool\IO;
use Seva\DrawingTool\Command\Canvas;

/**
 * Class ReaderTest
 * @package Seva\DrawingTool\IO
 * @covers \Seva\DrawingTool\IO\Reader
 */
class ReaderTest extends \PHPUnit_Framework_TestCase
{
	/**
	 * @var Reader
	 */
	var $reader;

	function setUp() {
		$this->reader = new Reader();
	}
	function tearDown() {
		$this->reader = null;
	}

	/**
	 * @covers \Seva\DrawingTool\IO\Reader::open
	 */
	function testOpenSuccess() {
		$string = 'test';
		$fileMock = 'data://text/plain,'.urlencode($string);
		$this->reader->open($fileMock);
		$lines = $this->reader->readLines();
		foreach($lines as $line) {
			$this->assertEquals($string, $line);
		}
	}

	/**
	 * @covers \Seva\DrawingTool\IO\Reader::open
	 * @expectedException \LogicException
	 */
	function testOpenFailure() {
		$this->reader->open('/');
	}

	/**
	 * @covers \Seva\DrawingTool\IO\Reader::close
	 */
	function testClose() {
		$this->reader->open('php://stdin');
		$isOpen = function() {/* @var $this Reader */
			return isset($this->stream);
		};
		$this->assertTrue($isOpen->call($this->reader));
		$this->reader->close();
		$this->assertFalse($isOpen->call($this->reader));
	}

	/**
	 * @covers \Seva\DrawingTool\IO\Reader::readLines
	 */
	function testReadLines() {
		$lines = [
			'line 1',
			'line 2',
			'line 3',
		];
		$fileMock = 'data://text/plain,'.urlencode(implode(PHP_EOL, $lines));
		$this->reader->open($fileMock);
		$readLines = iterator_to_array($this->reader->readLines());
		$this->assertEquals($lines, $readLines);
	}

	function testParseCommandSuccess() {
		$command = $this->reader->parseCommand('C 1 1');
		$this->assertInstanceOf(Canvas::class, $command);
	}

	/**
	 * @expectedException \LogicException
	 */
	function testParseCommandFailure() {
		$this->reader->parseCommand('something else');
	}

}
