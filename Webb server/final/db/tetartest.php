<?php
require '../phpincludes/phputil.php';
require '../phpincludes/plotupdate.php';
require '../phpincludes/polygon.php';
$m = new MongoClient();
$db = $m->selectDB('SocialMedia');
$collection = new MongoCollection($db, 'thirdClone');
$start = strtotime("2015-05-20 00:00:00");
$end = strtotime("2015-05-21 00:00:00");
$myC = $collection->find();//array('_id' => array('$gt' => timeToId($start), '$lte' => timeToId($end))));
//$data = tweetDataparser($cursor,null,null,null);//$datecheck,'created_at',array(datemakerStandard('2015-05-24'),datemakerStandard('2015-05-24')));
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
//foreach($myC as $gat){
//	var_dump($gat);
//	echo '<br>';
//}
$tweetAndArea = array();
foreach($myC as $tweet){
	echo 'försöker updatera.... ';
	$pp = false;
	$testCoord = array($tweet['coordinates']['coordinates'][0],$tweet['coordinates']['coordinates'][1]);
	foreach ($areaArray as $area) {
		if (pointInPolygon($area,$testCoord)){
			$newdata = array('$set' =>array("area" => $area['areaName']));
			$collection->update(array('_id' =>$tweet['_id']),$newdata);
			$pp = true;
		//$temp = array('_id' => $tweet['_id'] , 'area' =>$area['areaName']);
		//array_push($tweetAndArea,$temp);
	}
  }
  if(!$pp){
  	$newdata = array('$set' =>array("area" => null));
	$collection->update(array('_id' =>$tweet['_id']),$newdata);
  }
  echo "updaterad";
  echo '<br>';
}
//var_dump($tweetAndArea);

/*$m2 = new MongoClient();
$db2 = $m2->selectDB('SocialMedia');
$collection2 = new MongoCollection($db2, 'newCoordTest');
foreach ($tweetAndArea as $key) {
	echo 'försöker updatera.... ';
	$tjo = array("area" => $key['area']);
	$newdata = array('$set' => $tjo);
	var_dump($newdata);
	$hurdurr = $collection2->update(array('_id' =>$key['_id']),$newdata);
	echo "updaterad";
	echo '<br>';
	//foreach ($hurdurr as $key2) {
	//	var_dump($key2);
	//}
}
*/




function timeToId($ts) {
    // turn it into hex
    $hexTs = dechex($ts);
    // pad it out to 8 chars
    $hexTs = str_pad($hexTs, 8, "0", STR_PAD_LEFT);
    // make an _id from it
    return new MongoId($hexTs."0000000000000000");
}


//echo json_encode($json['features'][0][geometry][coordinates][0][0][0]);

/*$from = datemakerStandard('yesterday');
$until = datemakerStandard('yesterday');
$datebounds = array($from,$until);
$cursor1 = dataBaseCall('testcoord');
*/



	//$collection->update(array('_id'=>$doc['_id']),array('$set' => array('testProp' =>'superdouche')));
		




//$cursor2 = $collection->find()->sort(array('$natural' =>-1))->limit(2);
//foreach ($cursor2 as $doc2) {
//	var_dump($doc2);
//}
//function updateDoc($)