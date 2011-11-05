<?php
/**
 *
 */

namespace SETU\PositionOpeningNL\PositionSupplierNL\ContactMethod\PostalAddress;

class DeliveryAddress extends \SETU\SETU {

	/**
	 * The street name part of the address.
	 * Cardinality: 0..1
	 * @var
	 */
	protected $Streetname;
	/**
	 * The number of the building.
	 * Cardinality: 0..1
	 * @var
	 */
	protected $BuildingNumber;
	/**
	 * The number addition.
	 * Cardinality: 0..1
	 * @var
	 */
	protected $Unit;
	/**
	 * The post office box number.
	 * Cardinality: 0..1
	 * @var
	 */
	protected $PostOfficeBox;
}
