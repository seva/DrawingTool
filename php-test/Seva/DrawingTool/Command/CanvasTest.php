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
		return ['2x2' => [[2, 2], <<<EOS
----
|  |
|  |
----

EOS
			,]
		];
	}
}