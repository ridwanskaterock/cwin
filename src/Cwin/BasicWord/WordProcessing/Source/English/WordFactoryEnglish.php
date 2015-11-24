<?php 

namespace Cwin\BasicWord\WordProcessing\Source\English;

use Cwin\BasicWord\WordProcessing\Source\WordFactoryInterface;

class WordFactoryEnglish implements WordFactoryInterface
{
	public function sourceBaseWord()
	{
		$baseWordPath = __DIR__ . '/Data/Dictionary-english.txt';
		$basicWordContents = file_get_contents($baseWordPath);

		return $basicWordContents;
	}

	public function sourceBaseWordArr()
	{
		$basicWordContents = self::sourceBaseWord();
		$basicWordContentsArr = explode("\n", $basicWordContents);
		$basicWordContentsArrClean = [];

		foreach ($basicWordContentsArr as $word) {
			$basicWordContentsArrClean[] = trim(strtolower($word));
		}

		return $basicWordContentsArrClean;
	}
}