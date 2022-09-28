<?php
$mystring = 'Hallo nama saya muhamad ridwan';
$keyword = preg_split('/[.?!]/',$mystring);

var_dump($keyword);