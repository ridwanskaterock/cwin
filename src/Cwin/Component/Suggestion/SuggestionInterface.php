<?php

namespace Cwin\Component\Suggestion;

interface SuggestionInterface
{
	public function suggest();

	public function setSpelling($spellingResult);
}