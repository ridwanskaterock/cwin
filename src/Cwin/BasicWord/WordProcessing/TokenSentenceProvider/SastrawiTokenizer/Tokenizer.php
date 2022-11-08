<?php

namespace Cwin\BasicWord\WordProcessing\TokenSentenceProvider\SastrawiTokenizer;

use Cwin\BasicWord\WordProcessing\TokenSentenceProvider\TokenSentenceProviderInterface;

class Tokenizer implements TokenSentenceProviderInterface
{
	private $word;
	
	public function setWord($words)
	{
		if (!empty($words)) {
			$this->words = $words;
		}
	}

	public function getWord()
	{
		return $this->words;
	}

	public function steam($words)
	{
		$wordsArr = preg_split('/\s+|\b/', $words);

		return $wordsArr;
	}
}
