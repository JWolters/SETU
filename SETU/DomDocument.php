<?php
/**
 * ....
 */
namespace SETU;

class DomDocument extends \DOMDocument {
	/**
	* escape the given value correct for XML
	* @param $name
	* @param null $value
	* @return DOMElement
	*/
	public function createElement($name, $value = null) {

		$element = parent::createElement($name);

		if (!is_null($value)) {
			$element->appendChild(
				// createTextNode uses the right escaping
				$this->createTextNode($value)
			);
		}
		return $element;
	}


	/**
	* escape the given value correct for XML
	* @param $namespaceURI
	* @param $qualifiedName
	* @param null $value
	* @return DOMElement
	*/
	public function createElementNS($namespaceURI, $qualifiedName, $value = null) {

		$element = parent::createElementNS($namespaceURI, $qualifiedName);

		if (!is_null($value)) {
			$element->appendChild(
				// createTextNode uses the right escaping
				$this->createTextNode($value)
			);
		}
		return $element;
	}
}
