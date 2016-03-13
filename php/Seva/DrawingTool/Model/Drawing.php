<?php
namespace Seva\DrawingTool\Model;
/**
 * Class Drawing
 * @package Seva\DrawingTool\Model
 *
 * Stateful model for a drawing.
 */
class Drawing {

	protected $canvas;

	public function init(int $width, int $height, string $color): Drawing {
		$canvasLine   = array_fill(1, $width, $color);
		$this->canvas = array_fill(1, $height, $canvasLine);
		return $this;
	}

	public function getWidth(): int {
		return count($this->canvas[1]);
	}
	public function getHeight(): int {
		return count($this->canvas);
	}
	public function getColor(int $x, int $y): string {
		if(!$this->isValid($x, $y)) {
			return '';
		}
		return $this->canvas[$x][$y];
	}
	public function setColor(int $x, int $y, string $color): Drawing {
		if(!$this->isValid($x,$y)) {
			return $this;
		}
		$this->canvas[$x][$y] = $color;
		return $this;
	}
	protected function isValid(int $x, int $y): bool {
		return isset($this->canvas[$x][$y]);
	}
}