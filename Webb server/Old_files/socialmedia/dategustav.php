<?php

/* @var $searchword type */
require 'phputil.php';
//$searchword="sol";
$m = new MongoClient();
$db = $m->selectDB('SocialMedia');
$collection = new MongoCollection($db,'coordTweets');
$cursor = $collection->find()->sort(array('$natural' => -1))->limit(500);
$data1 =tweetDataparser($cursor,null,null,null);
//$yo = '05-05-2015';
//echo dateMakerStandard("Sat Apr 25 11:32:18 +0000 2015");// . 'tomorrow');
echo json_encode($data1);
//$datedata1=dateGrouper($data1,'date','value');
//$cursor2 = dataBaseCall('uppsalaTweets'); //$collection2->find();
//$data2 =tweetDataparser($cursor2,$wordcheck,'text',$searchword);
//$datedata2=dateGrouper($data2,'date','value');
//$mrdate = addDateGroups(array($datedata1,$datedata2)); //array();
//foreach ($datedata1 as $key=>$val){
//    $mrdate[$key] = $mrdate[$key] + $val;
//}
//foreach ($datedata2 as $key=>$val){
//    $mrdate[$key] = $mrdate[$key] + $val;
//}
//var_dump( $cursor->count() +$cursor2->count());
//echo '<br>';
//var_dump (count($data1)+count($data2));
//echo '<br>';
//var_dump($mrdate);
