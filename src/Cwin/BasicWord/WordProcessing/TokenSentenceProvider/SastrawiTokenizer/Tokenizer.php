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
		$wordsArr = preg_split('/[\s\,\.]/i', $words, -1, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);

		return $wordsArr;
	}
}
