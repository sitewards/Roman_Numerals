<?php
include_once(getcwd().'/Converter.php');
include_once(getcwd().'/TestConverter.php');

$oConverter = new Converter();
$oTestConverter = new TestConverter();

/*
 * Prompt the user to input a number
 *  - trim input just to make sure
 */
echo "Please enter a number you wish to convert:\n";
$oHandle = fopen('php://stdin', 'r');
$mUserInput = trim(fgets($oHandle));

try {
	$sRomanNumeral = $oConverter->convertIntegerToRomanNumeral($mUserInput);
	echo 'Number: ' . htmlspecialchars($mUserInput) . "\n";
	echo 'Roman Numeral: ' . $sRomanNumeral . "\n";

	$bValidatedRomanNumeral = $oTestConverter->testConversion($mUserInput, $sRomanNumeral);
	if($bValidatedRomanNumeral === true) {
		echo 'Validated at Wolfram Alpha';
	}
} catch (Exception $oException) {
	echo $oException->getMessage();
}