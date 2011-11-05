<?php
/**
 *
 */
namespace SETU;

abstract class SETU {

	protected $attributes        = array();
	protected $namespaces        = array();
	protected $cardinality       = array();
	protected $codelist          = array();
	protected $privateProperties = array(
		'attributes',
		'namespaces',
		'cardinality',
		'codelist',
		'privateProperties'
	);

	public function __call($property, $arguments) {
		if (property_exists($this, $property)) {
			if ($this->$property instanceof SETU) {
				return $this->$property;
			} else if (is_array($this->$property)) {
				// check cardinality
				$index = (int)$arguments[0];
				// TODO: what happens with *?
				if ($index < $this->cardinality[$property]['min'] ||
					($this->cardinality[$property]['max'] != '*' && $index > $this->cardinality[$property]['max'])) {
					throw new \Exception('Index out of bounds for property '.$property.'['.$index.'] in '.
						get_class($this));
				}
				if (!isset($this->{$property}[$index])) {
					$className = '\\'.get_class($this->{$property}[1]);
					$this->{$property}[$index] = new $className;
				}
				return $this->{$property}[$index];
			}
			// validation based on CodeList
			if (isset($this->codelist[$property]) && !in_array($arguments[0], $this->codelist[$property])) {
				throw new \Exception('Invalid value '.$arguments[0].' for property '.$property.' in '.get_class($this).
					' ('.implode(',', $this->codelist[$property]).')');
			}
			$this->$property = $arguments[0];
		} else if (isset($this->attributes[$property])) {
			// TODO: validation based on CodeList
			if (isset($this->attributes[$property]['codelist']) &&
				isset($this->codelist[$this->attributes[$property]['codelist']]) &&
				!in_array($arguments[0], $this->codelist[$this->attributes[$property]['codelist']])) {
				throw new \Exception('Invalid value '.$arguments[0].' for attribute '.$property.' in '.get_class($this).
					' ('.implode(',', $this->codelist[$this->attributes[$property]['codelist']]).')');
			}
			$this->attributes[$property]['value'] = $arguments[0];
		} else {
			throw new \Exception('Trying to set unknown property '.$property.' in '.get_class($this));
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
			// TODO: Exception if cardinality not found
			$this->cardinality[$propertyName] = array(
				'min' => $cardinality[1],
				'max' => isset($cardinality[2]) ? $cardinality[2] : $cardinality[1]
			);
			// check class-name
			$class = array();
			preg_match('/\*\sSETU-class:\s(.*)/i', $docComment, $class);
			if (isset($class[1])) {
				$reflectionClassName = $class[1];
			}
			// check codelist
			$codelist = array();
			preg_match('/\*\sSETU-codelist:\s(.*)/i', $docComment, $codelist);
			if (isset($codelist[1])) {
				$codelist = '\\SETU\\CodeList\\'.$codelist[1];
				$this->codelist[$propertyName] = $codelist::getList();
			}
			try {
				$max = $this->cardinality[$propertyName]['max'];
				if ($max != 1) {
					$value = array(
						1 => new $reflectionClassName()
					);
				} else {
					$value = new $reflectionClassName();
				}

			} catch (\Exception $e) {
				$value = null;
			}

			$this->$propertyName = $value;

		}

		foreach ($this->attributes as $attribute) {
			if (isset($attribute['codelist'])) {
				$codelist = '\\SETU\\CodeList\\'.$attribute['codelist'];
				$this->codelist[$attribute['codelist']] = $codelist::getList();
			}
		}
	}

	public function getDOMDocument() {
		$domDocument = new DomDocument('1.0', 'UTF-8');
		$domDocument->formatOutput = true;

		$className = get_class($this);
//echo 'getDOMDocument for '.$className.PHP_EOL;
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
					// TODO: check cardinality for element:0..1 and subelement: 1
					if ($childProperty instanceof SETU) {
						$element = $childProperty->getDOMDocument();
						if (!($this->cardinality[$propertyName]['min'] == 0 && $element->firstChild->childNodes->length == 0)) {
							$element = $domDocument->importNode($element->documentElement, true);
							$xmlRoot->appendChild($element);
						}
					}
				}
			} else if ($this->$propertyName instanceof SETU) {
				$element = $this->$propertyName->getDOMDocument();
				if (!($this->cardinality[$propertyName]['min'] == 0 && $element->firstChild->childNodes->length == 0)) {
					$element = $domDocument->importNode($element->documentElement, true);
					$xmlRoot->appendChild($element);
				}
			} else {
				if (!($this->cardinality[$propertyName]['min'] == 0 && empty($this->$propertyName))) {
					$element = $domDocument->createElement($propertyName, $this->$propertyName);
					$xmlRoot->appendChild($element);
				}
			}
		}

		// TODO: check cardinality?
		$domDocument->appendChild($xmlRoot);

		return $domDocument;
	}

	private function getReflectionProperties() {
		$reflection = new \ReflectionClass(get_class($this));
		$properties = $reflection->getProperties(\ReflectionProperty::IS_PROTECTED);
		foreach ($properties as $index => $property) {
			if (in_array($property->name, $this->privateProperties)) {
				unset($properties[$index]);
			}
		}
		return $properties;
	}

}
