<?php
/**
 *
 */
namespace SETU;

class PositionOpeningNL extends SETU {

	protected $attributes = array(
		/**
		 * eigenlijk geen $attributes maar $nameSpaces
		 */
		'xsi:schemaLocation' => array(
			'attribute' => 'xsi:schemaLocation',
			'value'     => 'http://ns.hr-xml.org/2007-04-15PositionOpeningNL.xsd'
		),
		'xmlns' => array(
			'attribute' => 'xmlns',
			'value'     => 'http://ns.hr-xml.org/2007-04-15'
		),
		'xmlns:xsi' => array(
			'attribute' => 'xml:xsi',
			'value'     => 'http://www.w3.org/2001/XMLSchema-instance'
		),
		/**
		* Specification of the languages in which the vacancy message is written.
		* Cardinality: 1
		* @var
		*/
		'VacancyLanguage' => array(
			'attribute' => 'xml:lang',
			'value'     => 'nl'
		)
	);

	/**
	 * Cardinality: 1
	 * @var
	 */
	protected $PositionRecordInfo;
	/**
	 * Cardinality: 1..4
	 * @var PositionSupplierNL
	 */
	protected $PositionSupplierNL;
	/**
	 * Cardinality: 1
	 * @var
	 */
	protected $PositionProfileNL;
	/**
	 * Cardinality: 0..1
	 * @var
	 */
	protected $ApplicationInformationNL;
	/**
	* Specification of the number of position openings this vacancy message applies to.
	* Cardinality: 0..1
	* Default: 1
	* @var
	*/
	protected $NumberToFill;
	/**
	 * Cardinality: 0..1
	 * @var
	 */
	protected $DistributionGuidelinesNL;

	/**
	 * Cardinality: 0..1
	 * @var
	 */
	protected $AdvertisementInfoNL;
	/**
	 * Cardinality: 0..1
	 * @var
	 */
	protected $ExtensionsNL;

}
