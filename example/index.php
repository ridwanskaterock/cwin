<?php 

require_once __DIR__ . '/../vendor/autoload.php';

use Cwin\BasicWord\WordProcessing\Source\Indonesia\WordFactoryIndonesia;
use Cwin\BasicWord\WordProcessing\Source\English\WordFactoryEnglish;

$wordSpelling = new Cwin\BasicWord\WordSpelling(new WordFactoryIndonesia);
$suggestion = new Cwin\Component\Suggestion\Suggestion();

$checkSpelling = $wordSpelling->checkSpelling('indonesi sudah merdeka sejak tahunn empat lima');
$suggestion->setMaxListSuggestion(3);

foreach ($checkSpelling->spellingResult() as $spelling) {
	echo '<span '.$spelling->getBaseWord().' '.($spelling->hasError() ? 'class="error word"' : 'class="word"').'>' . $spelling->getWord() ;
	if($spelling->hasError()) {
		echo " <span class='suggest'><ul><li>".implode("</li><li>", $suggestion->setSpelling($spelling)->suggest())."</li></ul></span> " ;
	}
	echo '</span> ';
}
