<?php
require '../phpincludes/phputil.php';
require '../phpincludes/plotupdate.php';
$m = new MongoClient();
$db = $m->selectDB('SocialMedia');
$collection = new MongoCollection($db, 'thirdClone');
$areaName =  $_POST['area'];
$myC = $collection->find(array('area' => $areaName))->sort(array('_id' => 1));//array('area' => $areaName));
$tweets= tweetDataparser($myC,null,null,null);
$plotData = dateGrouper($tweets,'date','value');
echo json_encode(array($tweets,$plotData));
//var_dump($tweets);