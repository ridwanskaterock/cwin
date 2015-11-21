<?php 
require_once __DIR__ . '/vendor/autoload.php';
ini_set("max_execution_time", 0);
$wordSpelling = new Cwin\BasicWord\WordSpelling;
$sentence = file_get_contents(__DIR__ . '/example.txt');
$checkSpelling = $wordSpelling->checkSpelling($sentence);

?>
<style type="text/css">	
	.error {
		color: #EB2424;
		font-weight: bold;
	}

	.suggest{
		position: absolute;
		background:#000;
		padding: 5px;
		color: #fff;
		border-radius: 5px;
	}

	.word {
		cursor: pointer;
	}
	.word .suggest {
		visibility: hidden;
	}

	.word:hover .suggest {
		visibility: visible;
	}

	.word .suggest:before {
		content:"\A";
	    border-style: solid;
	    border-width: 7px 11px 7px 0;
	    border-color: transparent #000 transparent transparent;
	    position: absolute;
	    left: -11px;
	}
</style>
<?php
foreach ($checkSpelling->spellingResult() as $result) {
	echo '<span '.$result->getBaseWord().' '.($result->hasError() ? 'class="error word"' : 'class="word"').'>' . $result->getWord() ;
	if($result->hasError()) {
		echo " <span class='suggest'>".implode("<br>", $result->getSuggestion(4))."</span> " ;
	}
	echo '</span> ';

}