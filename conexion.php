<?php

setlocale(LC_TIME, 'es_ES');
// BD local

 $user = "root";
 $base = "ejercicio2";
 $pass = "";
 $dbhost = "localhost";

 
global $db;
$db = new mysqli($dbhost, $user, $pass, $base) or die("Error with connection to database");
mysqli_set_charset($db, 'utf8');
date_default_timezone_set("America/Mexico_City");
