<?php
/**
 * bootstrap script for PHPUnit
 */
$rootDir = dirname(__DIR__);
include $rootDir.'/php/Seva/AutoLoader.php';
$loader = new \Seva\AutoLoader();
$loader->register()->addBaseDir($rootDir.'/php')->addBaseDir($rootDir.'/php-test');
