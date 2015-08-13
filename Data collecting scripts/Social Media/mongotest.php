#!/usr/bin/php -q
<?php

$m = new MongoClient();
$db = $m->SocialMedia;
$collection = $db->testData;
$document = array( "title" => "Skattkammaron", "author" => "Lol Lolsson");
$collection->insert($document);

$document = array( "title" => "KXCD", "online" => true );
$collection->insert($document);


$cursor = $collection->find(["title"=>"Skattkammaron"]);
foreach ($cursor as $document) {
	echo $document["title"] . "\n";
}
?>
