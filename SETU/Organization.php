<?php
/**
 *
 */

namespace SETU;

class Organization extends SETU {
	/**
	 * The name the company, that has a vacancy, uses in its daily communication. This name may be
	 * different from the official registered name of the company.
	 * Cardinality: 0..1
	 * @var
	 */
	protected $OrganizationName;
	/**
	 * A, human readable, description of the company that has a vacancy.
	 * Cardinality: 0..1
	 * @var
	 */
	protected $Description;
	/**
	 * A statement of the company of the company culture.
	 * Cardinality: 0..1
	 * @var
	 */
	protected $ValueStatement;
	/**
	 * The address of the webpage of the company.
	 * Cardinality: 0..1
	 * @var
	 */
	protected $InternetDomainName;
	/**
	 * The code of the industry the company is active in. The allowed options are definted by the
	 * SBI 2008 codelist.
	 * Cardinality: 0..1
	 * @var
	 */
	protected $Industrycode;
	/**
	 * The name of the contact point of the organisation. This may be a person, an office or any
	 * other available contactpoint. This contact information serves as the contact point for
	 * further information about the vacancy.
	 * Cardinality: 0..1
	 * @var
	 */
	protected $ContactName;
	/**
	 * Specification of how to reach the contactpoint. This container can contain an address,
	 * emailaddress, telephone number, mobile phone number and/or a facsimile number. This contact
	 * information serves as the contact method for further information about the vacancy.
	 * Cardinality: 0..1
	 * @var
	 */
	protected $ContactMethod;
	/**
	 * The descriptive name of the vacancy.
	 * Cardinality: 1
	 * @var
	 */
	protected $PositionTitle;
	/**
	 * The place where the candidate is going to work when being hired for the specified function.
	 * Cardinality: 1
	 * @var
	 */
	protected $PhysicalLocation;
	/**
	 * The specified discipline the function can be categorized in.
	 * Cardinality: 1
	 * @var
	 */
	protected $Jobcategory;
	/**
	 * A human readable description of the primary and secondary benefists the company that has the
	 * vacancy is offering to candidates.
	 * Cardinality: 0..1
	 * @var
	 */
	protected $RenumerationPackage;
	/**
	 * The number of hours the candidate must be willing to work each week.
	 * Cardinality: 1
	 * @var
	 */
	protected $WorkingHours;
	/**
	 * The number of days the candidate must be willing to work each week.
	 * Cardinality: 0..1
	 * @var
	 */
	protected $WorkingDays;
	/**
	 * The duration of the contract the company is offering.
	 * Cardinality: 1
	 * @var
	 */
	protected $ContractDuration;
	/**
	 * The type of contract that is offered.
	 * Cardinality: 1
	 * @var
	 */
	protected $ContractType;
}
