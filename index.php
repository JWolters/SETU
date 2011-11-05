<?php
/**
 * QAD autoloader
 */
spl_autoload_register(
	function($class) {
		// QAD loader
		$fileName = __DIR__.'/'.str_replace(array('_', '\\'), '/', $class).'.php';
		if (!is_file($fileName)) {
			throw new Exception('Class '.$class.' could not be loaded');
		}
//		echo 'Autoloading '.$fileName.' for '.$class.PHP_EOL;
		require_once $fileName;
		return spl_autoload($fileName);
	}
);

$PositionOpeningNL = new SETU\PositionOpeningNL();

$PositionOpeningNL->NumberToFill(1);

$PositionOpeningNL->PositionRecordInfo()->Id(1)->idOwner('owner');
$PositionOpeningNL->PositionRecordInfo()->Id(1)->IdValue('123456');
$PositionOpeningNL->PositionRecordInfo()->Status('x:post');

$PositionOpeningNL->PositionSupplierNL(1)->SuppliersIds()->SupplierId(1)->idOwner('owner');
$PositionOpeningNL->PositionSupplierNL(1)->SuppliersIds()->SupplierId(1)->IdValue('123');
$PositionOpeningNL->PositionSupplierNL(1)->SuppliersIds()->SupplierId(2)->idOwner('KVK');
$PositionOpeningNL->PositionSupplierNL(1)->SuppliersIds()->SupplierId(2)->IdValue('NL21136652');;

$PositionOpeningNL->PositionSupplierNL(1)->EntityName('Bedrijf A');
$PositionOpeningNL->PositionSupplierNL(1)->ContactName('Piet Janssen');

$PositionOpeningNL->PositionSupplierNL(1)->ContactMethod()->Telephone()->FormattedNumber('+31154789523');
$PositionOpeningNL->PositionSupplierNL(1)->ContactMethod()->InternetEmailAddress('piet.janssen@bedrijfa.nl');
$PositionOpeningNL->PositionSupplierNL(1)->ContactMethod()->SocialMedia()->SocialMedium(1)->SocialMediumParty('Linkedin');
$PositionOpeningNL->PositionSupplierNL(1)->ContactMethod()->SocialMedia()->SocialMedium(1)->SocialMediumIdentifier('pietjansen');
$PositionOpeningNL->PositionSupplierNL(1)->Role('owner');


$PositionOpeningNL->PositionSupplierNL(2)->SuppliersIds()->SupplierId(1)->idOwner('owner');
$PositionOpeningNL->PositionSupplierNL(2)->SuppliersIds()->SupplierId(1)->IdValue('a23b');
$PositionOpeningNL->PositionSupplierNL(2)->SuppliersIds()->SupplierId(1)->idOwner('recruiter');
$PositionOpeningNL->PositionSupplierNL(2)->SuppliersIds()->SupplierId(1)->IdValue('1');
$PositionOpeningNL->PositionSupplierNL(2)->SuppliersIds()->SupplierId(2)->idOwner('KVK');
$PositionOpeningNL->PositionSupplierNL(2)->SuppliersIds()->SupplierId(2)->IdValue('NL33136652');;

$PositionOpeningNL->PositionSupplierNL(2)->EntityName('Recruitmentbedrijf B');
$PositionOpeningNL->PositionSupplierNL(2)->ContactName('Henk Pietersen');

$PositionOpeningNL->PositionSupplierNL(2)->ContactMethod()->Telephone()->FormattedNumber('+31234789523');
$PositionOpeningNL->PositionSupplierNL(2)->ContactMethod()->InternetEmailAddress('henk.pietersen@recruitmentbedrijfb.nl');
$PositionOpeningNL->PositionSupplierNL(2)->ContactMethod()->SocialMedia()->SocialMedium(1)->SocialMediumParty('Linkedin');
$PositionOpeningNL->PositionSupplierNL(2)->ContactMethod()->SocialMedia()->SocialMedium(1)->SocialMediumIdentifier('henkpietersen');

$PositionOpeningNL->PositionSupplierNL(2)->ContactPersons()->ContactPerson(1)->ContactName('Recruiter 1');
$PositionOpeningNL->PositionSupplierNL(2)->ContactPersons()->ContactPerson(2)->ContactName('Recruiter 2');

var_dump($PositionOpeningNL->getDOMDocument()->saveXML());
//var_dump($PositionOpeningNL);