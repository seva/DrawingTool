#!/usr/bin/php
<?php @ob_end_clean();
/**
 * PHP CLI script to instantiate and execute the app logic
 */

echo <<<EOS
Huge Inc's code challenge DrawingTool
by Seva Lapsha

EOS;

echo <<<EOS
Initializing...

EOS;

$baseDir = dirname(__DIR__).'/php';
include $baseDir.'/Seva/AutoLoader.php';
$loader = new \Seva\AutoLoader();
$loader->register()->addBaseDir($baseDir);

$controller = new \Seva\DrawingTool\Controller();

$inputFile  = $argv[1];
$outputFile = $argv[2];

if(!strlen($inputFile) || !strlen($outputFile)) {
	echo <<<EOS
Both input and output files must be specified!

EOS;
	exit -1;
}

echo <<<EOS
Reading from "$inputFile" and writing to "$outputFile"...

EOS;


try {
	$controller->run($inputFile, $outputFile);
} catch (Exception $e) {
	trigger_error('Unexpected error '.$e->getMessage(), E_USER_ERROR);
}

echo <<<EOS
Finished reading from $inputFile and writing to "$outputFile"!

EOS;
