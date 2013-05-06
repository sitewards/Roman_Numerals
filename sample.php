<?php
include_once(getcwd().'/Converter.php');
$oConverter = new Converter();

echo "Please enter a number you wish to convert:\n";
$oHandle = fopen('php://stdin', 'r');
$mUserInput = trim(fgets($oHandle));

try {
	$sRomanNumeral = $oConverter->convertIntegerToRomanNumeral($mUserInput);
	echo 'Number: ' . htmlspecialchars($mUserInput) . "\n";
	echo 'Roman Numeral: ' . $sRomanNumeral;
} catch (Exception $oException) {
	echo $oException->getMessage();
}