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
		$this->initParams($params);
		$this->validateParams();

	}

	abstract protected function initParams(array $params);

	/**
	 * @throws \LogicException
	 */
	protected function validateParams() {
		// TODO proper validation, to be abstract
	}

	abstract function draw(Drawing $drawing): ACommand;
}