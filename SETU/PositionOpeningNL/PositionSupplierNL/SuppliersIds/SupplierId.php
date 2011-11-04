<?php
/**
 *
 */

namespace SETU\PositionOpeningNL\PositionSupplierNL\SuppliersIds;

class SupplierId extends \SETU\SETU {

	protected $attributes = array(
		/**
		 * Role of the issuer of the identifier.
		 */
		'vacancyIdOwner' => array(
			'attribute' => 'idOwner',
			// Permitted values: owner, recruiter, distributer, publicist, KVK, OIN, BTW, Fi
			'value'     => 'owner'
		),
		'validFrom' => array(
			'attribute' => 'validFrom',
			'value'     => null
		),
		'validTo' => array(
			'attribute' => 'validTo',
			'value'     => null
		)
	);
	/**
	 * Cardinality: 1..*
	 * @var
	 */
	protected $IdValue;
}
