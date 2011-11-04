<?php
/**
 *
 */

namespace SETU\PositionOpeningNL;

class PositionSupplierNL extends \SETU\SETU {

	/**
	 * Cardinality: 1
	 * @var
	 */
	protected $SuppliersIds;
	/**
	 * The name of the organisation of the specified role.
	 * Cardinality: 1
	 * @var
	 */
	protected $EntityName;
	/**
	 * The name of the contact point of the organisation. This may be a person, an office or any
	 * other available contactpoint.
	 * Cardinality: 1
	 * @var
	 */
	protected $ContactName;
	/**
	 * Specification of how to reach the contactpoint. This container can contain an address,
	 * emailaddress, telephone number, mobile phone number and/or a facsimile number.
	 * Cardinality: 0..1
	 * @var
	 */
	protected $ContactMethod;
	/**
	 * Cardinality: 1
	 * @var
	 */
	protected $Role;
	/**
	 * Cardinality: 1
	 * @var
	 */
	protected $SupplierId;
	/**
	 * Cardinality: 1
	 * @var
	 */
	protected $Organization;

}
