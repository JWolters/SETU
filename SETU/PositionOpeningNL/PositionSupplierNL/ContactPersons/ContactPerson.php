<?php
/**
 *
 */

namespace SETU\PositionOpeningNL\PositionSupplierNL\ContactPersons;

class ContactPerson extends \SETU\SETU {

	/**
	 * The name of the contact person.
	 * Cardinality: 1
	 * @var
	 */
	protected $ContactName;
	/**
	 * SETU-class: \SETU\ContactMethod
	 * Cardinality: 0..1
	 * @var
	 */
	protected $ContactMethod;
}
