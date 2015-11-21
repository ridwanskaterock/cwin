<?php

namespace Cwin\BasicWord\WordProcessing;

class WordSteammer
{
	private $words;

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
		$tokenizerFactory  = new \Sastrawi\Tokenizer\TokenizerFactory();
		$tokenizer = $tokenizerFactory->createDefaultTokenizer();
		$wordsArr = $tokenizer->tokenize($words);

		return $wordsArr;
	}
}