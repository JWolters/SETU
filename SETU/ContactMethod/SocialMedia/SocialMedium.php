<?php
/**
 *
 */

namespace SETU\ContactMethod\SocialMedia;

class SocialMedium extends \SETU\SETU {

	/**
	 * Specification of the social medium name according to the SETU codelist ‘socialMedia’.
	 * Cardinality: 1
	 * @var
	 */
	protected $SocialMediumParty;
	/**
	 * The identifier that can be used to ind the contact at the social medium
	 * Cardinality: 1
	 * @var
	 */
	protected $SocialMediumIdentifier;
}
