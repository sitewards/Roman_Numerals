<?php
include_once(getcwd().'/Converter.php');
$oConverter = new Converter();

echo "Lets format the number 14\n";
$iTheNumber1 = 14;
try {
	$sRomanNumeral = $oConverter->convertIntegerToRomanNumeral($iTheNumber1);
	echo var_dump($sRomanNumeral == 'XIV');
} catch (Exception $oException) {
	echo $oException->getMessage();
}