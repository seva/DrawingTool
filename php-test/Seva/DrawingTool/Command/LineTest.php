<?php

namespace Seva\DrawingTool\Command;

/**
 * Class CanvasTest
 * @package Seva\DrawingTool\Command
 * @covers \Seva\DrawingTool\Command\Line
 */
class LineTest extends ACommandTest
{
	function getCommandClass()
	{
		return Line::class;
	}

	static function providerDraw(): array
	{
		return [
			'horizontal' => [[2, 2, 4, 2], <<<EOS
-------
|     |
| xxx |
|     |
|     |
|     |
-------

EOS
			],
			'vertical' => [[2, 2, 2, 4], <<<EOS
-------
|     |
| x   |
| x   |
| x   |
|     |
-------

EOS
			]
		];
	}
}