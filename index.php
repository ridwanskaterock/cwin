<?php 
require_once __DIR__ . '/vendor/autoload.php';

set_time_limit(0);

$dictionary = new Cwin\BasicWord\WordProcessing\Source\Indonesia\WordFactoryIndonesia;
$wordFactory = new Cwin\BasicWord\WordProcessing\WordFactory($dictionary);
$wordSpelling = new Cwin\BasicWord\WordSpelling($wordFactory);


?>
<style type="text/css">	
	.error {
		color: #EB2424;
		font-weight: bold;
	}

	.suggest{
		position: absolute;
		background:rgba(0,0,0,0.5);
		padding: 5px;
		color: #fff;
		border-radius: 5px;
	}

	.word {
		cursor: pointer;
		line-height: 30px;
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
	    border-width: 7px 8px 7px 0;
	    border-color: transparent #000 transparent transparent;
	    position: absolute;
	    left: -4px;
	}

	.word ul li{
		list-style: none;
		margin:0px;
		padding: 0px;
	}

	.word ul {
		margin:0px;
		padding: 0px;
	}

</style>
<script type="text/javascript" src="../../jquery.js"></script>
<script type="text/javascript">
	$(document).ready(function(){
		$(".word .suggest ul li").click(function() {
			var select = $(this).html();
			var parent = $(this).parent().parent().parent();
			parent.html(select);
			parent.removeClass('error');
		});
	});
</script>
<form action="" method="POST" style="width:100%">
	<textarea name="sentence" style="width:100%"><?= isset($_POST['sentence']) ? $_POST['sentence'] : ''; ?></textarea>
	<button style="display:block; background:#970C0C; color:#fff; width:100%; padding:10px;">Steam</button>
</form>
<?php
if (isset($_POST['sentence'])) {
	$checkSpelling = $wordSpelling->checkSpelling($_POST['sentence']);

	foreach ($checkSpelling->spellingResult() as $result) {
		echo '<span '.$result->getBaseWord().' '.($result->hasError() ? 'class="error word"' : 'class="word"').'>' . $result->getWord() ;
		if($result->hasError()) {
			echo " <span class='suggest'><ul><li>".implode("</li><li>", $result->getSuggestion(2))."</li></ul></span> " ;
		}
		echo '</span> ';

	}
}

