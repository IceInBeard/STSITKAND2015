<?php

   header('Content-type: text/plain; charset=utf-8');
   try {
   $m = new MongoClient();
   }

   catch (MongoException $ex) {
 }

$db = $m->issuereporting; 
$collection = $db->report;

//date_default_timezone_set("Europe/Stockholm");
//$date =date("Y-m-d");
//$regex = new MongoRegex("/^" . $date . "/");
$issuesToday = $collection->count();

echo $issuesToday;

?> 
