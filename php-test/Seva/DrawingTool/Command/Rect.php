<?php

namespace Seva\DrawingTool\Command;

/**
 * Class CanvasTest
 * @package Seva\DrawingTool\Command
 * @covers \Seva\DrawingTool\Command\Rect
 */
class RectTest extends ACommandTest
{
	function getCommandClass()
	{
		return Rect::class;
	}

	static function providerDraw(): array
	{
		return [
			'3x3' => [[2, 2, 4, 4], <<<EOS
-------
|     |
| xxx |
| x x |
| xxx |
|     |
-------

EOS
			],
		];
	}
}