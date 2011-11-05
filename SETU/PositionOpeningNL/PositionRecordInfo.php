<?php
/**
 *
 */

namespace SETU\PositionOpeningNL;

class PositionRecordInfo extends \SETU\SETU {

	/**
	 * Vacancy identifier, issued by a certain role. This identifier must be unique to the issuer of the vacancy.
	 * Cardinality: 1..4
	 * @var string
	 */
	protected $Id;
	/**
	 * Specification of reason for sending the vacancy-message. This field specifies the desired vacancy status by the
	 * issuer.
	 * Cardinality: 1
	 * SETU-CodeList: SETU\vacancyStatus
	 * @var string
	 */
	protected $Status;

}
