<?php
namespace Seva\DrawingTool\Command;

use Seva\DrawingTool\Model\Drawing;

/**
 * Class Canvas
 * @package Seva\DrawingTool\Command
 *
 * A command to reset a canvas on a drawing
 */
class Canvas extends ACommand {

	const COLOR = ' ';

	static function getSymbol(): string {
		return 'C';
	}

	protected $width;
	protected $height;

	protected function initParams(array $params) {
		$this->width  = (int)$params[0];
		$this->height = (int)$params[1];
	}

	protected function normalizeParams(array $params): array {
		if(count($params) < 2) {
			throw new \LogicException('Must be 2 params');
		}
		$params = array_map('intval', $params);
		return $params;
	}
	function draw(Drawing $drawing): ACommand {
		$drawing->init($this->width, $this->height, static::COLOR);
		return $this;
	}
}