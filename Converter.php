<?php
/**
 * Class Converter
 *  - A simple class that provides a function that takes an integer value and converts it to Roman Numerals
 *  - NOTE: This has only been tested from number 1 to 5000
 *
 * @author Sitewards <https://github.com/sitewards>
 */
class Converter {
	/**
	 * An array of all the different rules for roman numerals
	 *
	 * @var array
	 */
	protected $aPatternsForIs = array(
		'/(?<!I{1})(I{1000})(?!I{4,})(I{1,3})/', // Should Match 1000 Is followed by exactly 1,2 or 3 Is
		'/I{1000}/', // Should Match 1000 Is
		'/(I{100})(I{800})/', // Should match 100 Is followed by exactly 800 Is
		'/(?<!I{1})(I{500})(?!I{4,})(I{1,3})/', // Should Match 500 Is followed by exactly 1,2 or 3 Is
		'/I{500}/', // Should Match 500 Is
		'/(I{100})(I{300})/', // Should match 100 Is followed by exactly 300 Is
		'/(?<!I{1})(I{100})(?!I{4,})(I{1,3})/', // Should Match 100 Is followed by exactly 1,2 or 3 Is
		'/I{100}/', // Should Match 100 Is
		'/(I{10})(I{80})/', // Should match 10 Is followed by exactly 80 Is
		'/(?<!I{1})(I{50})(?!I{4,})(I{1,3})/', // Should Match 50 Is followed by exactly 1,2 or 3 Is
		'/I{50}/', // Should Match 50 Is
		'/(I{10})(I{30})/', // Should match 10 Is followed by exactly 30 Is
		'/(?<!I{1})(I{10})(?!I{4,})(I{1,3})/', // Should Match 10 Is followed by exactly 1,2 or 3 Is
		'/I{10}/', // Should match 10 Is
		'/(I)(I{8})/', // Should match a I followed by exactly 8 Is
		'/(I{5})(I{1,3})/', // Should match 5 Is followed by exactly 1,2 or 3 Is
		'/I{5}/', // Should match 5 Is
		'/(I)(I{3})/', // Should match an I followed by 3 Is
	);

	/**
	 * An array of all the different replacements for each on the previously matched rules
	 *
	 * @var array
	 */
	protected $aReplacementsForIs = array(
		'M$2',
		'M',
		'$1M',
		'D$2',
		'D',
		'$1D',
		'C$2',
		'C',
		'$1C',
		'L$2',
		'L',
		'$1L',
		'X$2',
		'X',
		'$1X',
		'V$2',
		'V',
		'$1V',
	);

	/**
	 * Exception message for when the input is of the wrong type
	 */
	const EXCEPTION_MESSAGE_INPUT_WRONG_TYPE = 'A variable of the wrong type has been provided. The input must be an integer.';

	/**
	 * Exception message for when the input is outside the tested range
	 */
	const EXCEPTION_MESSAGE_INPUT_OUT_OF_RANGE = 'A variable that is outside the tested range has been provided. Sadly we have only tested between %1$s and %2$s.';

	/**
	 * The lowest tested value
	 */
	const LOWEST_TESTED_VALUE = 1;

	/**
	 * The highest tested value
	 */
	const HIGHEST_TESTED_VALUE = 5000;

	/**
	 * For a given integer
	 *  - split the number into a string containing just the letter "I"
	 *    - e.g. 14 becomes "IIIIIIIIIIIIII"
	 *  - make a call to replace multiples of this letter "I" with other roman numerals
	 *
	 * @param $iIntegerToBeConverted
	 * @return string
	 * @throws Exception
	 *  - when a non int is provided
	 *  - when an int outside of the tested range is provided
	 */
	public function convertIntegerToRomanNumeral($iIntegerToBeConverted) {
		if(!is_int($iIntegerToBeConverted)) {
			throw new Exception($this::EXCEPTION_MESSAGE_INPUT_WRONG_TYPE);
		} elseif (
			$iIntegerToBeConverted < $this::LOWEST_TESTED_VALUE
			||
			$iIntegerToBeConverted > $this::HIGHEST_TESTED_VALUE
		) {
			throw new Exception(
				sprintf(
					$this::EXCEPTION_MESSAGE_INPUT_OUT_OF_RANGE,
					$this::LOWEST_TESTED_VALUE,
					$this::HIGHEST_TESTED_VALUE
				)
			);
		}

		$sIntegerAsIs = $this->convertIntegerToIs($iIntegerToBeConverted);
		$sRomanNumeral = $this->convertIsToRomanNumeral($sIntegerAsIs);
		return $sRomanNumeral;
	}

	/**
	 * For a given string of the letter "I"
	 *  - perform a preg_replace with the defined patterns and replacements
	 *
	 * @param string $sNumberAsIs
	 * @return string
	 */
	private function convertIsToRomanNumeral($sNumberAsIs) {
		return preg_replace($this->aPatternsForIs, $this->aReplacementsForIs, $sNumberAsIs);
	}

	/**
	 * For a given integer
	 *  - Do a loop from 1 till the integer value
	 *  - Each time around the loop add another "I" to the new string
	 *
	 * @param $iIntegerInput
	 * @return string
	 */
	private function convertIntegerToIs($iIntegerInput) {
		$sNumberAsIs = '';
		for($iTimesAroundTheLoop = 1; $iTimesAroundTheLoop <= $iIntegerInput; $iTimesAroundTheLoop++) {
			$sNumberAsIs .= 'I';
		}
		return $sNumberAsIs;
	}
}