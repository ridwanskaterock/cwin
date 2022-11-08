<?php 

namespace Cwin\BasicWord;

use Cwin\BasicWord\WordProcessing\WordFactory;
use Cwin\BasicWord\WordProcessing\WordSteammer;
use Cwin\BasicWord\WordProcessing\SpellingResultProcessor;
use Cwin\BasicWord\WordProcessing\WordRule\IgnoreWordRule;
use Cwin\BasicWord\WordProcessing\Source\WordFactoryInterface;

class WordSpelling
{
	private $word;

	private $foreignWord;

	public $spellingResult;

	public function __construct(WordFactoryInterface $dictionary)
	{
		return self::changeDictionary($dictionary);
	}

	public function changeDictionary(WordFactoryInterface $dictionary)
	{
		self::resetSpellingResultData();
		$this->dictionary = $dictionary;

		return $this;
	}

	public function resetSpellingResultData()
	{
		$this->word = null;
		$this->foreignWord = null;
		$this->spellingResult = null;
	}

	public function addWord($word)
	{
		if (!empty($word)) {
			$this->word = $word;
		}

		return $this;
	}

	public function getWord()
	{
		return $this->word;
	}

	public function checkSpelling($word = '')
	{
		self::addWord($word);
		$word = self::getWord();
		$WordSteammerToken = new WordSteammer(new \Cwin\BasicWord\WordProcessing\TokenSentenceProvider\SastrawiTokenizer\Tokenizer);
		$wordArr = $WordSteammerToken->steam($word);
		$baseWordSource = $this->dictionary->sourceBaseWordArr();
		$ignoreWordRule = new IgnoreWordRule;
		$id = 0;

		foreach ($wordArr as $word) {
			if ($ignoreWordRule->wordIsIgnored($word) === false) {
				$wordCompare = strtolower(trim($word));

				if (in_array($wordCompare, $baseWordSource)) {
					self::addCorrectWord($id, $word);
				} else {
					self::addForeignWord($id, $word);
				}
			} else {
				self::addCorrectWord($id, $word);
			}

			$id++;
		}

		return $this;
	}

	public function addCorrectWord($id, $word)
	{
		$spellingResultProcessor = new SpellingResultProcessor($this->dictionary);
		$this->spellingResult[$id] = $spellingResultProcessor->setData([
			'id' => $id,
			'word' => $word,
			'foreign' => false
		]);

		return $this;
	}

	public function addForeignWord($id, $word)
	{
		$spellingResultProcessor = new SpellingResultProcessor($this->dictionary);
		$this->spellingResult[$id] = $spellingResultProcessor->setData([
			'id' => $id,
			'word' => $word,
			'foreign' => $word
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