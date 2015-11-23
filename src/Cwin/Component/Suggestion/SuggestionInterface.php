<?php

namespace Cwin\Component\Suggestion;

interface SuggestionInterface
{
	public function suggest($word, array $data);

	public function setDataSource($dataSource);

	public function getWord();

	public function setWord($word);

	public function getDataSource();
}