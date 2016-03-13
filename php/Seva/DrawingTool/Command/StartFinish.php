<?php
namespace Seva\DrawingTool\Command;

use Seva\DrawingTool\Model\Drawing;

/**
 * Class StartFinish
 * @package Seva\DrawingTool\Command
 *
 * An abstract command which draws a shape with a start and finish points
 */
abstract class StartFinish extends ACommand {
	protected $startX;
	protected $startY;
	protected $finishX;
	protected $finishY;

	protected function initParams(array $params) {
		$this->startX   = (int)$params[0];
		$this->startY   = (int)$params[1];
		$this->finishX  = (int)$params[2];
		$this->finishY  = (int)$params[3];
	}
	protected static final function drawVertical(Drawing $drawing, $x, $startY, $finishY, $color) {
		for($y = max($startY, 1), $finishY = min($finishY, $drawing->getHeight()); $y <= $finishY; ++$y) {
			$drawing->setColor($x, $y, $color);
		}
	}
	protected static final function drawHorizontal(Drawing $drawing, $startX, $finishX, $y, $color) {
		for($x = max($startX, 1), $finishX = min($finishX, $drawing->getWidth()); $x <= $finishX; ++$x) {
			$drawing->setColor($x, $y, $color);
		}
	}
}