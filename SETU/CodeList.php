<?php
/**
 *
 */

namespace SETU;

class CodeList  {

	public static function getList() {
		$reflection = new \ReflectionClass(get_called_class());
		return $reflection->getConstants();
	}

}
