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

	public abstract function initParams(array $params): ACommand;

	/**
	 * @throws \BadMethodCallException
	 */
	protected function validateParams(): ACommand {
		// TODO proper validation, to be abstract
		return $this;
	}

	abstract public function draw(Drawing $drawing): ACommand;
}