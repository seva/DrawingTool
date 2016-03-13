<?php
namespace Seva\DrawingTool\Command;

use Seva\DrawingTool\Model\Drawing;

/**
 * Class Rect
 * @package Seva\DrawingTool\Command
 *
 * A command to draw a rectangle on a canvas
 */
class Rect extends StartFinish {

	const COLOR = 'x';

	static function getSymbol(): string {
		return 'R';
	}
	function draw(Drawing $drawing): ACommand {
		static::drawHorizontal($drawing, $this->startX,  $this->finishX, $this->startY,  self::COLOR);
		static::drawHorizontal($drawing, $this->startX,  $this->finishX, $this->finishY, self::COLOR);
		static::drawVertical($drawing,   $this->startX,  $this->startY,  $this->finishY, self::COLOR);
		static::drawVertical($drawing,   $this->finishX, $this->startY,  $this->finishY, self::COLOR);
		return $this;
	}
}