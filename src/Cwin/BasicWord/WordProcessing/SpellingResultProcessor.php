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

	public $maxListSuggestion = 3;

	public  $dictionary = [];

	public function __construct($dictionary)
	{
		$this->dictionary = $dictionary;
	}

	public function setData($spellingResult)
	{
		foreach ($spellingResult as $key => $value) {
			if (isset($this->$key)) {
				$this->$key = $value;
			}
		}

		return $this;
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
}