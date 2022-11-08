<?php

use Cwin\BasicWord\WordProcessing\Source\Indonesia\WordFactoryIndonesia;
use Cwin\BasicWord\WordProcessing\Source\English\WordFactoryEnglish;
use Cwin\BasicWord\WordSpelling;

class SpellingTest extends PHPUnit_Framework_TestCase
{
	public function testCountResultSpelling()
	{
		$wordSpelling = new Cwin\BasicWord\WordSpelling(new WordFactoryIndonesia);
		$checkSpelling = $wordSpelling->checkSpelling('mari kita memrdekakan negri ini');

		$this->assertEquals(count($checkSpelling->spellingResult()), 5);
	}

	public function testResultIsArray()
	{
		$wordSpelling = new Cwin\BasicWord\WordSpelling(new WordFactoryIndonesia);
		$wordSpelling->addWord('mari kita memrdekakan negri ini');
		$checkSpelling = $wordSpelling->checkSpelling();

		$this->assertInternalType('array', $checkSpelling->spellingResult());
	}

	public function testWordSpellingError()
	{
		$wordSpelling = new Cwin\BasicWord\WordSpelling(new WordFactoryIndonesia);
		$wordSpelling->addWord('mmerdekkan');
		$checkSpelling = $wordSpelling->checkSpelling();

		foreach ($checkSpelling->spellingResult() as $spelling) {
			$this->assertTrue($spelling->hasError());
		}
	}

	public function testSpellingCorrectWord()
	{
		$wordSpelling = new Cwin\BasicWord\WordSpelling(new WordFactoryIndonesia);
		$wordSpelling->addWord('indonesia');
		$checkSpelling = $wordSpelling->checkSpelling();

		foreach ($checkSpelling->spellingResult() as $spelling) {
			$this->assertFalse($spelling->hasError());
			$this->assertInternalType('string', $spelling->getWord());
		}
	}

	public function testSpellingGetWord()
	{
		$wordSpelling = new Cwin\BasicWord\WordSpelling(new WordFactoryIndonesia);
		$wordSpelling->addWord('mari kita memrdekakan negri ini');

		$this->assertEquals('mari kita memrdekakan negri ini', $wordSpelling->getWord());
	}

	public function testAddCorrectWord()
	{
		$wordSpelling = new Cwin\BasicWord\WordSpelling(new WordFactoryIndonesia);
		$wordSpelling->addCorrectWord(1, 'indonesia');

		$this->assertTrue(is_object($wordSpelling->spellingResult()[1]));
		$this->assertEquals(count($wordSpelling->spellingResult()), 1);
	}

	public function testAddForeignWord()
	{
		$wordSpelling = new Cwin\BasicWord\WordSpelling(new WordFactoryIndonesia);
		$wordSpelling->addForeignWord(1, 'mrdka');

		$this->assertTrue(is_object($wordSpelling->spellingResult()[1]));
		$this->assertEquals(count($wordSpelling->spellingResult()), 1);
	}
}