Cwin
=========

Cwin (Chceck Word Indonesian)


Spelling
---------
Contohnya:

- indonesa => indonesia
- mrdeka => merdeka
- negri => negeri


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
$wordSpelling = new Cwin\BasicWord\WordSpelling;
$checkSpelling = $wordSpelling->checkSpelling('indonesi sudah merdeka sejak tahunn empat lima ');

foreach ($checkSpelling->spellingResult() as $result) {
    echo '<span '.($result->hasError() ? 'class="error word"' : 'class="word"').'>' . $result->getWord() ;
    if($result->hasError()) {
        echo " <span class='suggest'><ul><li>".implode("</li><li>", $result->getSuggestion(10))."</li></ul></span> " ;
    }
    echo '</span> ';

}

```

![Result](http://s28.postimg.org/5lmjlbx99/Screenshot_5.png)



