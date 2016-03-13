<?php
namespace Seva\DrawingTool\IO;

use Seva\DrawingTool\Model\Drawing;

/**
 * Class Writer
 * @package Seva\DrawingTool\IO
 *
 * Standard writer, uses a file as an output
 * Can be further abstracted to support more media
 */
class Writer {

	protected $stream;

	public function open($fileName) {
		$this->stream = @fopen($fileName, 'w+');
		if(!$this->stream) {
			throw new \LogicException("File $fileName is not writable");
		}
	}

	public function close() {
		if($this->stream) {
			@fclose($this->stream);
		}
		$this->stream = null;
	}

	const BORDER_HORIZONTAL = '-';
	const BORDER_VERTICAL   = '|';

	public function writeDrawing(Drawing $drawing) {
		$this->printBorderHorizontal($height = $drawing->getheight());
		$this->printEOL();
		$width = $drawing->getWidth();
		for($y = 1; $y <= $height; ++$y) {
			$this->printBorderVertical();
			for($x = 1; $x <= $width; ++$x) {
				$this->printColor($drawing->getColor($x, $y));
			}
			$this->printBorderVertical();
			$this->printEOL();
		}
		$this->printBorderHorizontal($drawing->getWidth());
		$this->printEOL();
	}
	protected function printBorderHorizontal($canvasWidth) {
		if(!$this->stream) {
			throw new \LogicException("No active stream");
		}
		fwrite($this->stream, str_repeat(self::BORDER_HORIZONTAL, $canvasWidth+2));
	}
	protected function printBorderVertical() {
		if(!$this->stream) {
			throw new \LogicException("No active stream");
		}
		fwrite($this->stream, self::BORDER_VERTICAL);
	}
	protected function printColor($color) {
		if(!$this->stream) {
			throw new \LogicException("No active stream");
		}
		fwrite($this->stream, $color);
	}
	protected function printEOL() {
		if(!$this->stream) {
			throw new \LogicException("No active stream");
		}
		fwrite($this->stream, PHP_EOL);
	}
}
