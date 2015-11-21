<?php

namespace Cwin\BasicWord\WordProcessing;

use Cwin\BasicWord\WordProcessing\TokenSentenceProvider\TokenSentenceProviderInterface;

class WordSteammer
{
	private $words;

	private $wordSteammerProvider;

	public function __construct(TokenSentenceProviderInterface $wordSteammerProvider)
	{
		$this->wordSteammerProvider = $wordSteammerProvider;
	}

	public function setWord($words)
	{
		$this->wordSteammerProvider->setWord($words);
	}

	public function getWord()
	{
		return $this->wordSteammerProvider->getWord();
	}

	public function steam($words)
	{
		return $this->wordSteammerProvider->steam($words);
	}
}