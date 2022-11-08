<?php

namespace Cwin\BasicWord\WordProcessing\TokenSentenceProvider;

interface TokenSentenceProviderInterface
{
	public function setWord($words);

	public function getWord();

	public function steam($words);
}
