<form action="" method="POST" style="width:100%">
	<textarea name="sentence" style="width:100%"><?= isset($_POST['sentence']) ? $_POST['sentence'] : ''; ?></textarea>
	<button style="display:block; background:#970C0C; color:#fff; width:100%; padding:10px;">Steam</button>
</form>
<?php
// demo.php

// include composer autoloader
require_once __DIR__ . '/vendor/autoload.php';

// create stemmer
// cukup dijalankan sekali saja, biasanya didaftarkan di service container
$stemmerFactory = new \Sastrawi\Stemmer\StemmerFactory();
$stemmer  = $stemmerFactory->createStemmer();

if (isset($_POST['sentence'])) {
	echo $stemmer->stem($_POST['sentence']) . "\n";
}
?>
