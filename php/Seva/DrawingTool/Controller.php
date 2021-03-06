<?php

namespace Seva\DrawingTool;

use Seva\DrawingTool\IO\Reader;
use Seva\DrawingTool\IO\Writer;
use Seva\DrawingTool\Model\Drawing;

/**
 * Class Controller
 * @package Seva\DrawingTool
 *
 * execution flow
 */
class Controller {
	public function run(string $inputFile, string $outputFile) {
		$reader = new Reader();
		$reader->open($inputFile);
		$writer = new Writer();
		$writer->open($outputFile);
		$drawing = new Drawing();
		foreach($reader->readLines() as $line) {
			try {
				$command = $reader->parseCommand($line);
				$command->draw($drawing);
				$writer->writeDrawing($drawing);
			} catch (\LogicException $e) {
				trigger_error($e->getMessage(), E_USER_WARNING);
			}
		}
		$writer->close();
		$reader->close();
	}
}