<?php
namespace Seva\DrawingTool\Model;
use Seva\DrawingTool\Command\ACommand;

/**
 * Class Drawing
 * @package Seva\DrawingTool\Model
 *
 * Stateful model for a drawing.
 */
class Drawing {

	const NULL_COLOR = '';

	protected $canvas;

	function init(int $width, int $height, string $color): Drawing {
		$canvasLine   = array_fill(1, $width, $color);
		$this->canvas = array_fill(1, $height, $canvasLine);
		return $this;
	}

	/**
	 * reverse control
	 * @param ACommand $command
	 * @return Drawing
	 */
	function draw(ACommand $command): Drawing {
		$command->draw($this);
		return $this;
	}

	function getWidth(): int {
		return count($this->canvas[1]);
	}
	function getHeight(): int {
		return count($this->canvas);
	}
	function getColor(int $x, int $y): string {
		if(!$this->isValid($x, $y)) {
			return self::NULL_COLOR;
		}
		return $this->canvas[$y][$x];
	}
	function setColor(int $x, int $y, string $color): Drawing {
		if(!$this->isValid($x,$y)) {
			return $this;
		}
		$this->canvas[$y][$x] = $color;
		return $this;
	}
	protected function isValid(int $x, int $y): bool {
		return isset($this->canvas[$y][$x]);
	}
}