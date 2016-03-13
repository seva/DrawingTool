<?php

namespace Seva\DrawingTool\Command;

/**
 * Class CanvasTest
 * @package Seva\DrawingTool\Command
 * @covers \Seva\DrawingTool\Command\Canvas
 */
class CanvasTest extends ACommandTest
{
	function getCommandClass()
	{
		return Canvas::class;
	}

	static function providerDraw(): array
	{
		return ['4x2' => [[4, 2], <<<EOS
------
|    |
|    |
------

EOS
			]
		];
	}
}