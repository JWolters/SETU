<?php
/**
 *
 */
namespace SETU;

abstract class SETU {

	protected $attributes  = array();
	protected $namespaces  = array();
	protected $cardinality = array();

	public function __call($method, $arguments) {
		var_dump($method, $arguments);
		if (property_exists($this, $method)) {
			if ($this->$method instanceof SETU) {
				return $this->$method;
			} else if (is_array($this->$method)) {
				return $this->{$method}[$arguments[0]];
			}
			$this->$method = $arguments[0];
		}
	}

	public function __construct() {

		foreach ($this->getReflectionProperties() as $property) {
			$propertyName = $property->name;
			$className = get_class($this);
			$reflectionClassName = '\\'.$className.'\\'.$propertyName;

			// TODO: create function(s)
			// check cardinality
			$property = new \ReflectionProperty(get_class($this), $propertyName);
			$docComment = $property->getDocComment();
			$cardinality = array();
			preg_match('/\*\sCardinality:\s(\d)\.?\.?([\d\*])?/i', $docComment, $cardinality);

			$this->cardinality[$propertyName] = array(
				'min' => $cardinality[1],
				'max' => isset($cardinality[2]) ? $cardinality[2] : $cardinality[1]
			);

			try {
				$max = $this->cardinality[$propertyName]['max'];
				if ($max != 1) {
					// TODO: how to allow * (∞)?
					if ($max == '*') {
						$max = 1;
					}
					$value = array_fill(1, $max, new $reflectionClassName());
				} else {
					$value = new $reflectionClassName();
				}

			} catch (\Exception $e) {
				$value = null;
			}
			$this->$propertyName = $value;

		}
	}

	public function getDOMDocument() {
		$domDocument = new DomDocument('1.0', 'UTF-8');
		$domDocument->formatOutput = true;

		$className = get_class($this);
		// strip namespaces
		$className = substr($className, 1 + strrpos($className, '\\'));

		$xmlRoot = $domDocument->createElement($className);

		foreach ($this->attributes as $attribute) {
			if (!empty($attribute['value'])) {
				$xmlRoot->setAttribute($attribute['attribute'], $attribute['value']);
			}
		}

		foreach ($this->getReflectionProperties() as $property) {
			$propertyName = $property->name;

			if (is_array($this->$propertyName)) {
				foreach ($this->$propertyName as $childProperty) {
					if ($childProperty instanceof SETU) {
						$element = $childProperty->getDOMDocument();
						$element = $domDocument->importNode($element->documentElement, true);
						// TODO: check cardinality?
						$xmlRoot->appendChild($element);
					}
				}
			} else if ($this->$propertyName instanceof SETU) {
				$element = $this->$propertyName->getDOMDocument();
				$element = $domDocument->importNode($element->documentElement, true);
				$xmlRoot->appendChild($element);
			} else {
				$element = $domDocument->createElement($propertyName, $this->$propertyName);
				$xmlRoot->appendChild($element);
			}
			// TODO: check cardinality
//			if (!($this->cardinality[$propertyName] == 0 && $element->childNodes->length == 0)) {
//				$xmlRoot->appendChild($element);
//			}

		}

		// TODO: check cardinality?
		$domDocument->appendChild($xmlRoot);

		return $domDocument;
	}

	private function getReflectionProperties() {
		$reflection = new \ReflectionClass(get_class($this));
		$properties = $reflection->getProperties(\ReflectionProperty::IS_PROTECTED);
		foreach ($properties as $index => $property) {
			switch($property->name) {
				case 'attributes':
				case 'namespaces':
				case 'cardinality':
					unset($properties[$index]);
					break;
			}
		}
		return $properties;
	}

}

class SETU2 {

	private $XML;
	private $xmlRoot;

	public function __construct() {

		$this->XML = new DomDocument('1.0', 'UTF-8');
		$this->XML->formatOutput = true;

		$className = get_class($this);

		$this->xmlRoot = $this->XML->createElement(
			substr($className, 1 + strlen(__NAMESPACE__))
		);

		$reflection = new \ReflectionClass($className);
		$properties = $reflection->getProperties(\ReflectionProperty::IS_PRIVATE);

		foreach ($properties as $property) {
			try {
				$reflectionClassName = __NAMESPACE__.'\\'.$property->name;
				$reflectionClass = new $reflectionClassName();

				$element = $reflectionClass->getXML();

				if ($element->hasChildNodes() == false) {
					throw new \Exception();
				}
				$element = $this->XML->importNode($element->documentElement, true);
			} catch (\Exception $e) {
				$element = $this->XML->createElement($property->name);
			}
			$this->xmlRoot->appendChild($element);


		}

		$this->XML->appendChild($this->xmlRoot);
	}

	public function __toString() {
		return $this->XML->saveXML();
	}

	public function getXML() {
		return $this->XML;
	}

}
