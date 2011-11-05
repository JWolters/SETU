<?php
/**
 *
 */

namespace SETU\ContactMethod;

class PostalAddress extends \SETU\SETU {

	/**
	 * Cardinality: 0..1
	 * @var
	 */
	protected $DeliveryAddress;
	/**
	 * The postal code part of the address.
	 * Cardinality: 0..1
	 * @var
	 */
	protected $PostalCode;
	/**
	 * The city part of the address.
	 * Cardinality: 0..1
	 * @var
	 */
	protected $Municipality;
	/**
	 * The country code of the address. (ISO 3166-1)
	 * Cardinality: 1
	 * @var
	 */
	protected $Countrycode;
	/**
	 * The region or provence part of the address.
	 * Cardinality: 0..1
	 * @var
	 */
	protected $Region;
}
