<?php 

namespace Cwin\BasicWord\WordProcessing;

use Cwin\BasicWord\WordProcessing\Source\WordFactoryInterface;

class WordFactory implements WordFactoryInterface
{
	public function __construct(WordFactoryInterface $sourceWord)
	{
		$this->dictionary = $sourceWord;
	}

	public function sourceBaseWord()
	{
		return $this->dictionary->sourceBaseWord();
	}

	public function sourceBaseWordArr()
	{
		return $this->dictionary->sourceBaseWordArr();
	}
}