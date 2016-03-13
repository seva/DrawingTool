<?php
namespace Seva\DrawingTool\Command;

use Seva\DrawingTool\Model\Drawing;

/**
 * Class ACommand
 * @package Seva\DrawingTool\Command
 *
 * Abstract command
 * Can draw a shape on a drawing
 */
abstract class ACommand {
	/**
	 * @return string
	 */
	abstract static function getSymbol(): string;

	function __construct(array $params = []) {
		$this->normalizeParams($params);
		$this->initParams($params);

	}

	abstract protected function initParams(array $params);

	/**
	 * @throws \LogicException
	 */
	abstract protected function normalizeParams(array $params): array;

	abstract function draw(Drawing $drawing): ACommand;
}