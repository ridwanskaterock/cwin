<?php

use Cwin\BasicWord\WordProcessing\Source\Indonesia\WordFactoryIndonesia;
use Cwin\BasicWord\WordSpelling;

class SuggestionTest extends PHPUnit_Framework_TestCase
{
	public function testCountSuggestion()
	{
		$wordSpelling = new Cwin\BasicWord\WordSpelling(new WordFactoryIndonesia);
		$suggestion = new Cwin\Component\Suggestion\Suggestion();
		$checkSpelling = $wordSpelling->checkSpelling('mrdka');

		foreach ($checkSpelling->spellingResult() as $spelling) {
			$this->assertEquals(count($suggestion->setSpelling($spelling)->setMaxListSuggestion(3)->suggest()), 3);
		}
	}

	public function testResultSuggestionIsArray()
	{
		$wordSpelling = new Cwin\BasicWord\WordSpelling(new WordFactoryIndonesia);
		$suggestion = new Cwin\Component\Suggestion\Suggestion();
		$checkSpelling = $wordSpelling->checkSpelling('mrdka');

		foreach ($checkSpelling->spellingResult() as $spelling) {
			$this->assertTrue(is_array($suggestion->setSpelling($spelling)->suggest()));
		}
	}
}
