<?php 

namespace Cwin\BasicWord;

use Cwin\BasicWord\WordProcessing\WordFactory;
use Cwin\BasicWord\WordProcessing\WordSteammer;
use Cwin\BasicWord\WordProcessing\SpellingResultProcessor;
use Cwin\BasicWord\WordProcessing\WordRule\IgnoreWordRule;

class WordSpelling
{
	private $word;

	private $foreignWord;

	private $spellingResult;

	public function addWord($word)
	{
		if (!empty($word)) {
			$this->word = $word;
		}
	}

	public function getWord()
	{
		return $this->word;
	}

	public function checkSpelling($word)
	{
		self::addWord($word);
		$word = self::getWord();
		$WordSteammerToken = new WordSteammer(new \Cwin\BasicWord\WordProcessing\TokenSentenceProvider\SastrawiTokenizer\Tokenizer);
		$wordArr = $WordSteammerToken->steam($word);
		$baseWordSource = WordFactory::sourceBaseWordArr();
		$id = 0;
		$stemmerFactory = new \Sastrawi\Stemmer\StemmerFactory();
		$stemmer = $stemmerFactory->createStemmer();

		foreach ($wordArr as $word) {
			$baseWord = $stemmer->stem($word);
			$baseWord = strtolower(trim($baseWord));

			if (IgnoreWordRule::wordIsIgnored($baseWord) === false) {
				if (in_array($baseWord, $baseWordSource)) {
					self::addCorrectWord($id, $word, $baseWord);
				} else {
					self::addForeignWord($id, $word, $baseWord);
				}
			} else {
				self::addCorrectWord($id, $word, $baseWord);
			}

			$id++;
		}

		return $this;
	}

	public function addCorrectWord($id, $word, $baseWord)
	{
		$this->spellingResult[$id] = new SpellingResultProcessor([
			'id' => $id,
			'word' => $word,
			'foreign' => false,
			'baseWord' => $baseWord
		]);

		return $this;
	}

	public function addForeignWord($id, $word, $baseWord)
	{
		$this->spellingResult[$id] = new SpellingResultProcessor([
			'id' => $id,
			'word' => $word,
			'foreign' => $word,
			'baseWord' => $baseWord
		]);
		
		$this->foreignWord[$id] = $word;

		return $this;
	}

	public function getForeignWord()
	{
		return $this->foreignWord;
	}

	public function spellingResult()
	{
		return $this->spellingResult;
	}
}