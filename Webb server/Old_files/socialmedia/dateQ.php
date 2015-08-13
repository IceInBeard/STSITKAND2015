<?php
function timeToId($ts) {
    // turn it into hex
    $hexTs = dechex($ts);
    // pad it out to 8 chars
    $hexTs = str_pad($hexTs, 8, "0", STR_PAD_LEFT);
    // make an _id from it
    return new MongoId($hexTs."0000000000000000");
}

function dateQuery($targetCol, $startDate, $endDate){
	$m = new MongoClient(); // connect
	$db = $m->selectDB("SocialMedia");

	$collection = $db->$targetCol;
	$start = timeToId($startDate);
	$end = timeToId($endDate);
	$cursor = $collection->find(array('_id' => array('$gt' => $start, '$lte' => $end)));
	foreach ($cursor as $doc){
	echo $doc["created_at"] . "/n";
	}

	return $cursor;
}


$start = strtotime("2015-05-01 00:00:00");
$end = strtotime("2015-05-03 00:00:00");

$cursor = dateQuery("coordTweets", $start, $end);

foreach ($cursor as $doc){
	echo "hej";
}

