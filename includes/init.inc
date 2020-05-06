<?php
//start na sesiq za da moje da ima login
session_start();

$mysqli = new mysqli('localhost', 'root', '', 'food'); 
//kodirovka utf-8
$mysqli->set_charset('utf8');

 // snimkite se add-vat v $animal_pictires_dir
 $animal_pictires_dir = 'images/foodpics/'; //direktoriq za snimkite
 // za vseki produkt - snimka s max-width: 180px 
 // +ime kato na osn.snimka, zaedno s: $animal_pictires_small_prefix.
$animal_pictires_small_prefix = 'small_';
?>