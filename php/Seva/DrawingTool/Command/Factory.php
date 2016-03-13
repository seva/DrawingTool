<?php
namespace Seva\DrawingTool\Command;

/**
 * Class Factory
 * @package Seva\DrawingTool\Command
 *
 * Factory to create command objects
 */
class Factory {
	protected static $registry = [
		Canvas::class,
		Line::class,
		Rect::class,
		Fill::class,
	];

	public static function createCommand(string $symbol, array $params): ACommand {
		$commandClass = self::getSymbolCommand($symbol);
		return new $commandClass($params);
	}

	protected static function getSymbolCommand(string $symbol): string {
		$symbolCommands = self::getSymbolCommands();
		if(!isset($symbolCommands[$symbol])) {
			throw new \LogicException("Symbol $symbol is unknown");
		}
		return $symbolCommands[$symbol];
	}

	protected static function getSymbolCommands(): array {
		static $symbolCommands = [];
		if(!$symbolCommands) {
			foreach(self::$registry as $command) {
				/* @var $command ACommand */
				$symbolCommands[$command::getSymbol()] = $command;
			}
		}
		return $symbolCommands;
	}

}