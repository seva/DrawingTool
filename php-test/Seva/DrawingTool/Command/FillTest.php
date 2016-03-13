<?php

namespace Seva\DrawingTool\Command;

/**
 * Class CanvasTest
 * @package Seva\DrawingTool\Command
 * @covers \Seva\DrawingTool\Command\Fill
 */
class FillTest extends ACommandTest
{
	function getCommandClass()
	{
		return Fill::class;
	}

	static function providerDraw(): array
	{
		return [
			'center F' => [[3, 3, 'F'], <<<EOS
-------
|FFFFF|
|FFFFF|
|FFFFF|
|FFFFF|
|FFFFF|
-------

EOS
			],
		];
	}
}