<?php

namespace Seva;

/**
 * Simple Autoloader
 * Attempts to load classes from base directory
 * Replaces Namespace separators with directory separators
 *
 */
class AutoLoader {
	const NAMESPACE_SEPARATOR = '\\';
	const FILE_SUFFIX = '.php';

	private $baseDirs = [];
	private $registered = false;

	/**
	 * Registers the autoloader to load the classes
	 * @uses AutoLoader::load()
	 */
	public function register(): AutoLoader {
		if($this->registered) {
			return $this;
		}
		spl_autoload_register(array($this, 'load'));
		$this->registered = true;
		return $this;
	}

	public function addBaseDir(string $baseDir) {
		$this->baseDirs[] = $baseDir;
		return $this;
	}

	/**
	 * Actual loading of the class
	 */
	protected function load(string $className): bool {
		foreach($this->baseDirs as $baseDir) {
			$fileName = $baseDir.DIRECTORY_SEPARATOR
				. str_replace(self::NAMESPACE_SEPARATOR, DIRECTORY_SEPARATOR, $className)
				. self::FILE_SUFFIX;
			if(!file_exists($fileName)) {
				continue;
			}
			include($fileName);
			if(class_exists($className, false)) {
				return true;
			}
		}
		return false;
	}
}