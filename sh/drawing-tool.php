#!/usr/bin/php
<?php @ob_end_clean();

/**
 * PHP CLI script to instantiate and execute the app logic
 */
$baseDir = dirname(__DIR__).'/php';
include $baseDir.'/Seva/AutoLoader.php';
$loader = new \Seva\AutoLoader();
$loader->register()->addBaseDir($baseDir);

$controller = new \Seva\DrawingTool\Controller();
try {
	$controller->run($argv[1], $argv[2]);
} catch (Exception $e) {
	trigger_error(E_USER_ERROR, 'Unexpected error '.$e->getMessage());
}
