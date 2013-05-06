<?php
/**
 * Class TestConverter
 *  - A class that will call the wolfram alpha api to validate a users conversion
 *
 * @author Sitewards <https://github.com/sitewards>
 */
class TestConverter {
	/**
	 * The App Id from Wolfram Alpha
	 */
	const WOLFRAM_ALPHA_APP_ID = 'T6E4XU-GJ39Y2UE2P';

	/**
	 * The url for the wolfram alpha api
	 */
	const WOLFRAM_ALPHA_API_URL = 'http://api.wolframalpha.com/v2/query?appid=%1$s&input=%2$s&format=plaintext&includepodid=%3$s';

	/**
	 * The pod id for Roman Numerals in wolfram alpha
	 */
	const WOLFRAM_ALPHA_POD_ID = 'RomanNumerals';

	/**
	 * Exception when a connection simplexml_load_file fails
	 */
	const EXCEPTION_CONNECTION_ERROR = 'There is an error connecting to wolfram alpha. Please check your internet connection';

	/**
	 * Exception when response section is missing
	 */
	const EXCEPTION_EMPTY_NODE = 'The information provided could not be validated via wolfram alpha';

	/**
	 * Exception when there is a validation error
	 */
	const EXCEPTION_MATCH_ERROR = 'The integer %1$s has be converted as %2$s but Wolfram Alpha has returned %3$s';

	/**
	 * From the given integer
	 *  - create a url for wolfram alpha
	 *  - send request
	 *  - process the node "pod/subpod/plaintext"
	 *  - validate that this node is the same as the reg_ex result
	 *
	 * @param int $iIntegerToBeConverted
	 * @param string $sRegExResult
	 * @return bool
	 * @throws Exception
	 *  - when there is an error with simplexml_load_file
	 *  - when there is an error loading the correct node
	 */
	public function testConversion($iIntegerToBeConverted, $sRegExResult) {
		$sWolframAlphaURL = $this->getWolframAlphaUrl($iIntegerToBeConverted);

		$oResponseXml = simplexml_load_file($sWolframAlphaURL);
		if($oResponseXml === false) {
			throw new Exception($this::EXCEPTION_CONNECTION_ERROR);
		}

		$oPodSection = $oResponseXml->pod->subpod->plaintext;
		if($oPodSection === false) {
			throw new Exception($this::EXCEPTION_EMPTY_NODE);
		}

		$sWolframAlphaResponse = (string)$oPodSection;

		if($sWolframAlphaResponse == $sRegExResult) {
			return true;
		}

		throw new Exception(
			sprintf(
				$this::EXCEPTION_MATCH_ERROR,
				$iIntegerToBeConverted,
				$sRegExResult,
				$sWolframAlphaResponse
			)
		);
	}

	/**
	 * From a mixed input build the wolfram alpha url
	 *
	 * @param mixed $mWolframAlphaQuery
	 * @return string
	 */
	private function getWolframAlphaUrl($mWolframAlphaQuery) {
		return sprintf(
			$this::WOLFRAM_ALPHA_API_URL,
			htmlspecialchars($this::WOLFRAM_ALPHA_APP_ID),
			htmlspecialchars($mWolframAlphaQuery),
			htmlspecialchars($this::WOLFRAM_ALPHA_POD_ID)
		);
	}
}