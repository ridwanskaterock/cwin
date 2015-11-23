<?php

namespace Cwin\Component\Suggestion;

use Fuzzy\Fuzzy;

class FuzzySuggestion implements SuggestionInterface
{
	private $dataSource;

	private $word;

	public function suggest($word, array $data)
	{
		self::setWord($word);
		self::setDataSource($data);
		$fuzzySearch = new Fuzzy;
		$fuzzySearchResult = $fuzzySearch->search($this->dataSource, $this->word, count($this->word)); 

		return $fuzzySearchResult;
	}

	public function setDataSource($dataSource)
	{
		if (isset($dataSource) AND count($dataSource) > 0)
		{
			$this->dataSource = $dataSource;
		}

		return $this;
	}

	public function getWord()
	{
		return $this->word;
	}

	public function setWord($word)
	{
		if (isset($word) AND !empty($word))
		{
			$this->word = $word;
		}

		return $this;
	}

	public function getDataSource()
	{
		return $this->word;
	}
}