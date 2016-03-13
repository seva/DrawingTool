<?php
namespace Seva\DrawingTool\IO;

use Seva\DrawingTool\Command\ACommand;
use Seva\DrawingTool\Command\Factory;

/**
 * Class Reader
 * @package Seva\DrawingTool\IO
 *
 * Standard reader, uses a file as an input
 * Can be further abstracted support more media
 */
class Reader {

	protected $stream;

	public function open(string $fileName) {
		$this->stream = @fopen($fileName, 'r');
		if(!$this->stream) {
			throw new \LogicException("File $fileName is not readable");
		}
		return $this;
	}

	public function close() {
		if($this->stream) {
			@fclose($this->stream);
		}
		$this->stream = null;
	}

	function readLines(): \Traversable {
		if(!$this->stream) {
			throw new \LogicException("No active stream");
		}
		while(($line = fgets($this->stream)) !== false) {
			yield trim($line);
		}
	}

	/**
	 * @param $line
	 * @return ACommand
	 */
	function parseCommand(string $line) {
		$tokens = preg_split('/\s+/', $line, -1, PREG_SPLIT_NO_EMPTY);
		$symbol = array_shift($tokens);
		return Factory::createCommand($symbol, $tokens);
	}
}