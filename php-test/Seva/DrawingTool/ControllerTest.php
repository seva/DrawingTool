<?php
/**
 * Created by IntelliJ IDEA.
 * User: Seva
 * Date: 2016-03-13
 * Time: 5:18 PM
 */

namespace Seva\DrawingTool;


use Seva\DrawingTool\IO\WriterTest;

/**
 * Class ControllerTest
 * @package Seva\DrawingTool
 * @covers \Seva\DrawingTool\Controller
 */
class ControllerTest extends \PHPUnit_Framework_TestCase {
	/**
	 * @covers \Seva\DrawingTool\Controller::run
	 */
	function testRun() {
		$rootDir = dirname(dirname(stream_resolve_include_path('bootstrap.php')));
		$resDir = $rootDir.DIRECTORY_SEPARATOR.'res';
		$inputDistFile  = $resDir.DIRECTORY_SEPARATOR.'input.dist.txt';
		$outputDistFile = $resDir.DIRECTORY_SEPARATOR.'output.dist.txt';
		$outputFile = $resDir.DIRECTORY_SEPARATOR.'output.txt';
		$controller = new Controller();
		$controller->run($inputDistFile, $outputFile);
		// $this->assertFileEquals($outputFile, $outputDistFile); // may fail due to EOL differences
		$this->assertEquals(WriterTest::normalize(file_get_contents($outputDistFile)), WriterTest::normalize(file_get_contents($outputFile)));
	}
}
