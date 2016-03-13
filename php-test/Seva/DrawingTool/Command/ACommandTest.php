<?php

namespace Seva\DrawingTool\Command;
use Seva\DrawingTool\IO\Writer;
use Seva\DrawingTool\IO\WriterTest;
use Seva\DrawingTool\Model\Drawing;

/**
 * Class ACommandTest
 * @package Seva\DrawingTool\Command
 * @covers \Seva\DrawingTool\Command\ACommand
 */
abstract class ACommandTest extends \PHPUnit_Framework_TestCase {

	const CANVAS_SIZE = [5, 5];


	/**
	 * @return ACommand class
	 */
	abstract function getCommandClass();

	/**
	 * @covers \Seva\DrawingTool\Command\ACommand::getSymbol
	 * @covers \Seva\DrawingTool\Command\Factory::getSymbolCommand
	 */
	function testGetSymbolFactory() {
		$commandClass = $this->getCommandClass();
		$symbol = $commandClass::getSymbol();
		$getSymbolCommands = function(string $symbol) {/* @var $this Factory */return $this->getSymbolCommand($symbol);};
		$factoryCommandClass = $getSymbolCommands->call(new Factory(), $symbol);
		$this->assertEquals($commandClass, $factoryCommandClass, "Mismatching symbol $symbol for command $commandClass");
	}

	/**
	 * @param array $params
	 * @param string $expected
	 * @dataProvider providerDraw
	 */
	function testDraw(array $params, string $expected) {
		$drawing = new Drawing();
		$drawing->draw(new Canvas(self::CANVAS_SIZE));
		$commandClass = $this->getCommandClass();
		$command = new $commandClass($params);
		/* @var $command ACommand */
		$command->draw($drawing);
		$actual = $this->printDrawing($drawing);
		$this->assertEquals(WriterTest::normalize($expected), WriterTest::normalize($actual));
	}

	abstract static function providerDraw(): array;

	function printDrawing(Drawing $drawing) {
		$writer = (new Writer())->open('php://memory')->writeDrawing($drawing);
		return WriterTest::getStreamContent($writer);
	}
}
