<?php

namespace Cwin\Component\Suggestion;

use Cwin\Component\Suggestion\SuggestionInterface;

class Suggestion implements SuggestionInterface
{
	private $maxListSuggestion = 3;

	private $word;

	private $dictionary;

	public function setSpelling($spellingResult)
	{
		$this->word = $spellingResult->word;
		$this->dictionary = $spellingResult->dictionary;
		$this->maxListSuggestion = $spellingResult->maxListSuggestion;
		$exceptionWord = [];

		return $this;
	}

	public function suggest()
	{
		$word = $this->word;
		$dictionary = $this->dictionary;
		$maxListSuggestion = $this->maxListSuggestion;
		$exceptionWord = [];

		self::setMaxListSuggestion($maxListSuggestion);
		self::setWord(strtolower($word));
		$shortest = -1;
		$countClosest = 0;
		$goodSuggestion = null;

		foreach ($dictionary->sourceBaseWordArr() as $word) {
			if (in_array($word, $exceptionWord)) {
				continue;
			}

		    $lev = levenshtein($this->word, $word);

		    if ($lev == 0) {
		        $listSuggestion = [];
		        $shortest = 0;

		        break;
		    }

		    if ($lev <= $shortest || $shortest < 0) {
		        $listSuggestion[$countClosest]  = $word;
		        $goodSuggestion = $word;
		        $shortest = $lev;
		    }

		    $countClosest++;
		}

		if ($shortest == 0) {
			return [];
		} else {
		   	return self::sorting($listSuggestion, $this->word);
		}
	}

	public function sorting($suggestResult, $word)
	{
		$reserveArr = array_reverse($suggestResult, FALSE);

		return self::improveGoodResult($reserveArr, $word);
	}

	public function improveGoodResult($suggestResult, $word)
	{
		$improveGoodResult = [];
		$improveGoodResultToCut = [];

		foreach ($suggestResult as $result) {
			$avgLength = ( strlen( $word ) + strlen( $result ) ) / 2;
			$matchFraction = 1 - ( levenshtein( $word, $result ) / $avgLength );

			$improveGoodResult[] = [
				'matching' => similar_text($word, $result), 
				'word' => $result
			];
		}

		foreach ($improveGoodResult as $key => $row) {
		    $matching[$key]  = $row['matching'];
		    $wordArr[$key] = $row['word'];
		}

		array_multisort($matching, SORT_DESC, $wordArr, SORT_DESC, $improveGoodResult);

		foreach ($improveGoodResult as $row) {
			$improveGoodResultToCut[] = $row['word'];
		}

		return self::cutMaxSuggestion($improveGoodResultToCut, $word);
	}

	public function cutMaxSuggestion($suggestResult, $word)
	{
		$suggestResultSelection = [];
		$suggestResultSelection = array_slice($suggestResult, 0, $this->maxListSuggestion);

		return $suggestResultSelection;
	}

	public function setMaxListSuggestion($maxNumber)
	{
		if (isset($maxNumber) AND $maxNumber > 0) {
			$this->maxListSuggestion = $maxNumber;
		}

		return $this;
	}

	public function setWord($word)
	{
		if (isset($word) AND !empty($word)) {
			$this->word = $word;
		}

		return $this;
	}

}