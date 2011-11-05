<?php
/**
 *
 */
namespace SETU\PositionOpeningNL\PositionRecordInfo;

class Id extends \SETU\SETU {

	protected $attributes = array(
		/**
		 * Role of the issuer of the identifier. The allowed options are provided by the SETU codelist ‘vacancyRoles’. The
		 * entity who has this role is specified in the PositionSupplier container.
		 * Cardinality: 1
		 * @var string
		 */
		'idOwner' => array(
			'attribute' => 'idOwner',
			'value'     => null
		)
	);
	/**
	 * Cardinality: 0..1
	 * @var
	 */
	protected $IdValue;

}
