
<?php
require 'phputil.php';
require 'plotupdate.php';
$params = array('un'=> 'Gustafv', 'key' => 'af5a12w562', 'filename' => '"tweetplot"', 'title' => '"Tweets over time"');
$cursor = dataBaseCall('coordTweets');
$cursor2 = dataBaseCall('uppsalaTweets');
$data = tweetDataparser($cursor,null,null);
$data2 = tweetDataparser($cursor2,null,null);
$plotlydata = addDateGroups(array(dateGrouper($data,'date','value'),dateGrouper($data2,'date','value')));
uppdateplotly($plotlydata,$params);
echo json_encode($data);

