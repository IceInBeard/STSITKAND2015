<?php
require 'phputil.php';
require 'plotupdate.php';
$params = array('un'=> 'Gustafv', 'key' => 'af5a12w562', 'filename' => '"tweetplot"', 'title' => '"Tweets over time"');
$from = datemakerStandard($_POST['from']);
$until = datemakerStandard($_POST['until']);
$searchword = $_POST['searchWord'];
$datebounds = array($from,$until);
$cursor1 = dataBaseCall('coordTweets');
$cursor2 = dataBaseCall('uppsalaTweets');
$data1 = tweetRefinedDataparser(tweetDataparser($cursor1,$datecheck,'created_at',$datebounds),$wordcheck,'Text',$searchword);
$data2 = tweetRefinedDataparser(tweetDataparser($cursor2,$datecheck,'created_at',$datebounds),$wordcheck,'Text',$searchword);
$plotdata = addDateGroups(array(dateGrouper($data,'date','value'),dateGrouper($data2,'date','value')));
//uppdateplotly($plotlydata,$params);
$data=array($data1, $cursor1->count()+$cursor2->count(), count($data1)+count($data2),$data2,$plotdata);
echo json_encode($data);