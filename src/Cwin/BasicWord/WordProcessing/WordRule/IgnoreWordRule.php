<?php 

namespace Cwin\BasicWord\WordProcessing\WordRule;

class IgnoreWordRule
{
	public function wordIsIgnored($word)
	{
		if (self::ruleIsOneLetter($word)) {
			return true;
		}

		if (self::ruleIsNumber($word)) {
			return true;
		}

		if (self::ruleIgnoreWord($word)) {
			return true;
		}

		if (self::ruleIsSymbol($word)) {
			return true;
		}

		return false;
	}

	public function ruleIsOneLetter($word)
	{
		if (strlen($word) == 1) {
			return true;
		} else {
			return false;
		}
	}

	public function ruleIsNumber($word)
	{
		if (is_numeric($word)) {
			return true;
		} else {
			return false;
		}
	}

	public function ruleIgnoreWord($word)
	{
		$wordIsIgnoreList = ['di', 'ke'];
		$implodeList = implode("|", $wordIsIgnoreList);

		if (preg_match("/(" . $implodeList . ")/", $word)) {
			return true;
		} else {
			return false;
		}
	}

	public function ruleIsSymbol($word)
	{
		$listChar = "[ ~ ` ! @ # $ % ^ & * ( ) _ - + = \ [ \ ] { } \ | \ \ : ; \" \ ' < , > . ]";
		$listCharArr = explode(' ', $listChar);

		if(preg_match("/(\\".implode('|\\', $listCharArr).")/", $word)) {
	        return true;
		} else {
			return false;
		}
	}
}