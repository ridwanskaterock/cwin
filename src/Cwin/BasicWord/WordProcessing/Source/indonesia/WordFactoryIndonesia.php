<?php 

namespace Cwin\BasicWord\WordProcessing\Source\Indonesia;

use Cwin\BasicWord\WordProcessing\Source\WordFactoryInterface;

class WordFactoryIndonesia implements WordFactoryInterface
{
	public function sourceBaseWord()
	{
		$baseWordPath = __DIR__ . '/Data/kata-dasar.txt';
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