<?php
require '../phpincludes/phputil.php';
require '../phpincludes/plotupdate.php';
require '../phpincludes/polygon.php';
/*
$str = file_get_contents('../js/GeJSONtest.json');
$json = json_decode($str, true);

$features = $json['features'];
$areaArray = array();

foreach ($features as $area){
	$polyX = array();
	$polyY = array();
	foreach ($area['geometry']['coordinates'][0] as $coordinates){
		if (count($polyX)<count($area['geometry']['coordinates'][0])-1) {
			array_push($polyX, $coordinates[0]);
			array_push($polyY, $coordinates[1]);
		}
	}
	$temp = array('areaName' => $area['properties']['name'],
					'polySides' => count($area['geometry']['coordinates'][0])-1,
					'polyX' => $polyX,
					'polyY' => $polyY
					);
array_push($areaArray, $temp);
}
*/

//hämta hela dtabas


//FÖr varje tweet från databasen

//hämta objectid
//

/*$testCoord = array('long' =>17.648160,"lat" => 59.838529);

foreach ($areaArray as $area) {
	if (pointInPolygon($area,$testCoord)){
	echo $area['areaName'];
}
}



echo json_encode($json['features'][0][geometry][coordinates][0][0][0]);
*/
/*$from = datemakerStandard('yesterday');
$until = datemakerStandard('yesterday');
$datebounds = array($from,$until);
$cursor1 = dataBaseCall('testcoord');
*/
$m = new MongoClient();
$db = $m->selectDB('SocialMedia');
$collection = new MongoCollection($db, 'testcoord');
$cursor = $collection->find()->sort(array('$natural' => -1))->limit(20);

$texts=array();
foreach ($cursor as $doc) {
	var_dump($doc);

	//$collection->update(array('_id'=>$doc['_id']),array('$set' => array('testProp' =>'superdouche')));
		
}



//$cursor2 = $collection->find()->sort(array('$natural' =>-1))->limit(2);
//foreach ($cursor2 as $doc2) {
//	var_dump($doc2);
//}
//function updateDoc($)