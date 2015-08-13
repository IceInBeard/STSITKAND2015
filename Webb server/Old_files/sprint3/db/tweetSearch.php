<?php

/* @var $searchword type */
require '../phpincludes/phputil.php';
require '../phpincludes/plotupdate.php';
$params = array('un'=> 'Gustafv', 'key' => 'af5a12w562', 'filename' => '"tweetplot"', 'title' => '"Tweets over time"');
$searchword=$_POST['searchWord'];
$cursor1 = dataBaseCall('coordTweets');
$data1 =tweetDataparser($cursor1,$wordcheck,'text',$searchword);
$cursor2 = dataBaseCall('uppsalaTweets');
$data2 =tweetDataparser($cursor2,$wordcheck,'text',$searchword);
$plotdata = addDateGroups(array(dateGrouper($data1,'date','value'),dateGrouper($data2,'date','value')));
//uppdateplotly($plotlydata,$params);
$data=array($data1, $cursor1->count()+$cursor2->count(), count($data1)+count($data2),$data2,$plotdata);
echo json_encode($data);
