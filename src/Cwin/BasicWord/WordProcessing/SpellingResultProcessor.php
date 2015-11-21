<?php

namespace Cwin\BasicWord\WordProcessing;

use Cwin\BasicWord\WordProcessing\WordFactory;
use Cwin\BasicWord\WordProcessing\WordSteammer;
use Cwin\BasicWord\WordProcessing\SpellingResultProcessor;
use Cwin\BasicWord\WordProcessing\WordRule\IgnoreWordRule;
use Cwin\BasicWord\Feature\Suggestion;

class SpellingResultProcessor
{
	public $word = '';

	public $foreign = '';

	public $baseWord = '';

	public $id = '';

	public function __construct($spellingResult)
	{
		foreach ($spellingResult as $key => $value) {
			if (isset($this->$key)) {
				$this->$key = $value;
			}
		}
	}

	public function hasError()
	{
		if ($this->foreign) {
			return true;
		} else {
			return false;
		}
	}

	public function getIdWord()
	{
		return $this->id;
	}

	public function getWord()
	{
		return $this->word;
	}

	public function getBaseWord()
	{
		return $this->baseWord;
	}

	public function getSuggestion()
	{
		if (self::hasError()) {
			$word = $this->word;
			$exceptionWord = [];
			$baseWordSource = WordFactory::sourceBaseWordArr();
			$maxLIstSuggestion = 5;
			$suggest = Suggestion::suggest($word, $baseWordSource, $exceptionWord, $maxLIstSuggestion);

			return $suggest;
		}
	}
}