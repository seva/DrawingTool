<?php
namespace Seva\DrawingTool\Command;

use Seva\DrawingTool\Model\Drawing;

/**
 * Class Line
 * @package Seva\DrawingTool\Command
 *
 * A command to draw a line on a canvas
 */
class Line extends StartFinish {

	const COLOR = 'x';

	static function getSymbol(): string {
		return 'L';
	}
	public function draw(Drawing $drawing): ACommand {
		if($this->startY == $this->finishY) {
			static::drawHorizontal($drawing, $this->startX, $this->finishX, $this->startY, self::COLOR);
			return $this;
		}
		if($this->startX == $this->finishX) {
			static::drawVertical($drawing, $this->startX, $this->startY, $this->finishY, self::COLOR);
			return $this;
		}
		throw new \LogicException('Only horizontal or vertical lines supported');
	}

}