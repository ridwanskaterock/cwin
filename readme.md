Cwin
=========

Cwin (Correct Word Indonesian)


Spelling
---------
Contohnya:

- indonesa => indonesia
- mrdeka => merdeka
- negri => negeri
- membagun => membangun



Contoh kasus
-------------
Dalam penulisan kata kadangkala tidak pernah tertinggal dari typo atau salah ejaan
untuk menghindari ketidaksesuaian dalam penulisan diperlukan pengecekan otomatis yang di lakukan untuk koreksi kata (check spelling), dan akan menampilkan suggestion kata yang dimaksud



Penggunaan
-----------

Copy kode berikut di directory project anda. Lalu jalankan file tersebut.

```php
<?php 
require_once __DIR__ . '/vendor/autoload.php';

use Cwin\BasicWord\WordProcessing\Source\Indonesia\WordFactoryIndonesia;

$dictionary = new Cwin\BasicWord\WordProcessing\WordFactory(new WordFactoryIndonesia);
$wordSpelling = new Cwin\BasicWord\WordSpelling($dictionary);
$suggestion = new Cwin\Component\Suggestion\Suggestion();

$checkSpelling = $wordSpelling->checkSpelling('indonesi sudah merdeka sejak tahunn empat lima');
$suggestion->setMaxLIstSuggestion(3);

foreach ($checkSpelling->spellingResult() as $spelling) {
	echo '<span '.($spelling->hasError() ? 'class="error word"' : 'class="word"').'>' . $spelling->getWord() ;
	if($spelling->hasError()) {
		echo " <span class='suggest'><ul><li>".implode("</li><li>", $suggestion->setSpelling($spelling)->suggest())."</li></ul></span> " ;
	}
	echo '</span> ';
}





```

![Result](http://s28.postimg.org/5lmjlbx99/Screenshot_5.png)



