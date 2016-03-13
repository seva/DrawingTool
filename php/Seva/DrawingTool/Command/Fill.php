<?php
namespace Seva\DrawingTool\Command;

use Seva\DrawingTool\Model\Drawing;

/**
 * Class Fill
 * @package Seva\DrawingTool\Command
 *
 * A command to fill empty space with a given color
 * @link https://en.wikipedia.org/wiki/Flood_fill#Alternative_implementations
 */
class Fill extends ACommand {

	static function getSymbol(): string {
		return 'B';
	}
	protected $x;
	protected $y;
	protected $color;

	protected function initParams(array $params) {
		$this->x     = $params[0];
		$this->y     = $params[1];
		$this->color = $params[2];
	}

	protected function normalizeParams(array $params): array {
		if(count($params) < 3) {
			throw new \LogicException('Must be 3 params');
		}
		foreach([0,1] as $num) {
			$params[$num] = (int)$params[$num];
		}
		$params[2] = $params[2]{0}; // first char
		return $params;
	}


	function draw(Drawing $drawing): ACommand {
		$currentColor = $drawing->getColor($this->x, $this->y);
		if(!static::isFillable($drawing, $this->x, $this->y, $currentColor)) {
			return $this;
		}
		$queue = [];
		array_push($queue, [$this->x, $this->y]);
		while($queue) {
			list($x, $y) = array_shift($queue);
			$east = $west = $x;
			while(static::isFillable($drawing, $west, $y, $currentColor)) {
				++$west;
			}
			while(static::isFillable($drawing, $east, $y, $currentColor)) {
				--$east;
			}
			for($x = $east+1; $x < $west; ++$x) {
				$drawing->setColor($x, $y, $this->color);
				$south = $y+1;
				if(static::isFillable($drawing, $x, $south, $currentColor)) {
					array_push($queue, [$x, $south]);
				}
				$north = $y-1;
				if(static::isFillable($drawing, $x, $north, $currentColor)) {
					array_push($queue, [$x, $north]);
				}
			}
		}
		return $this;
	}
	static function isFillable(Drawing $drawing, int $x, int $y, string $color): bool {
		$currentColor = $drawing->getColor($x, $y);
		if($currentColor == Drawing::NULL_COLOR) {
			return false;
		}
		return $currentColor == $color;
	}
}