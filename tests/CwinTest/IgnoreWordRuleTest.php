<?php

use Cwin\BasicWord\WordProcessing\WordRule\IgnoreWordRule;

class IgnoreWordRuleTest extends PHPUnit_Framework_TestCase
{
	public function testWordIsIgnore()
	{
		$ignoreWordRule = new IgnoreWordRule;

		$this->assertTrue($ignoreWordRule->wordIsIgnored('.'));
	}

	public function testRuleIsOneLetter()
	{
		$ignoreWordRule = new IgnoreWordRule;

		$this->assertTrue($ignoreWordRule->ruleIsOneLetter('1'));
	}

	public function testRuleIsNumber()
	{
		$ignoreWordRule = new IgnoreWordRule;

		$this->assertTrue($ignoreWordRule->ruleIsNumber(1234));
	}

	public function testRuleIgnoreWord()
	{
		$ignoreWordRule = new IgnoreWordRule;

		$this->assertTrue($ignoreWordRule->ruleIgnoreWord('di'));
		$this->assertTrue($ignoreWordRule->ruleIgnoreWord('ke'));
		$this->assertFalse($ignoreWordRule->ruleIgnoreWord('si'));
	}

	public function testRuleIsSymbol()
	{
		$ignoreWordRule = new IgnoreWordRule;

		$this->assertTrue($ignoreWordRule->ruleIsSymbol('$ %'));
		$this->assertFalse($ignoreWordRule->ruleIsSymbol('a'));
	}
}