<?php 

namespace Cwin\BasicWord\WordProcessing;

class WordFactory
{
	public function sourceBaseWord()
	{
		$baseWordPath = __DIR__ . '/Source/kata-dasar.txt';
		$basicWordContents = file_get_contents($baseWordPath);

		return $basicWordContents;
	}

	public function sourceBaseWordArr()
	{
		$basicWordContents = self::sourceBaseWord();
		$basicWordContentsArr = explode("\n", $basicWordContents);

		return $basicWordContentsArr;
	}
}