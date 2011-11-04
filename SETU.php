<?php
/**
 * QAD autoloader
 */
spl_autoload_register(
	function($class) {
		// QAD loader
		$fileName = __DIR__.'/'.str_replace(array('_', '\\'), '/', $class).'.php';
		if (!is_file($fileName)) {
			throw new Exception('Class '.$class.' could not be loaded');
		}
//		echo 'Autoloading '.$fileName.PHP_EOL;
		require_once $fileName;
		return spl_autoload(str_replace('_', '/', $class));
	}
);

$SETU = new SETU\PositionOpeningNL();

$SETU->NumberToFill(1);
$SETU->PositionRecordInfo()->Status('x:post');
$SETU->PositionRecordInfo()->Id(1)->IdValue('tester');

var_dump($SETU->getDOMDocument()->saveXML());