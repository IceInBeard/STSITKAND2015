<?php
require 'phpincludes/phputil.php';
require 'phpincludes/plotupdate.php';
$from = datemakerStandard('today');
$until = datemakerStandard('tomorrow');
$datebounds = array($from,$until);
$cursor1 = dataBaseCall('coordTweets');
$cursor2 = dataBaseCall('uppsalaTweets');
$data1 = tweetDataparser($cursor1,$datecheck,'created_at',$datebounds);
$data2 = tweetDataparser($cursor2,$datecheck,'created_at',$datebounds);
$result = count($data1)+count($data2);
echo $result;
?> 