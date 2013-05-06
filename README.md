Roman_Numerals
==============

A simple php converter from integer to Roman numerals.

Files
------------------
* One class Converter.php
	* Function convertIntegerToRomanNumeral($iIntegerToBeConverted)
		* Convert the parameter $iIntegerToBeConverted into Roman numerals
		* Uses a set of regular expression rules
		* Validates that the parameter is of the correct type
		* Validates that the parameter is inside the current tested range
* One class TestConverter.php
	* Function testConversion($iIntegerToBeConverted, $sRegExResult)
		* Given a parameter $iIntegerToBeConverted and $sRegExResult
		* Call the wolfram alpha api for the Roman numerals section
		* Validates that the returned value matches the parameter $sReqExResult
* One simple.php
	* Simple command line script
		* Ask the user for an integer they would like to convert
		* Call the function convertIntegerToRomanNumeral,
		* Display the results or appropriate errors to the user,
		* Call the function testConversion
		* Display a message if the Roman Numeral has been validated,
