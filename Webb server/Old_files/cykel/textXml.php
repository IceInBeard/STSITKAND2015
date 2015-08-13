<?php

$data=file("http://www1.infracontrol.com/cykla/xml2.asp?system=uppsala");

$str = preg_replace("/[^0-9]/","",$data[12]);
//echo $str;


   header('Content-type: text/plain; charset=utf-8');
   try {
   $m = new MongoClient();
   }

   catch (MongoException $ex) {
 
  
 }
$today = date("Y-m-d"); 
//$today = "2015-05-09";
$db = $m->bicycle;
$collection = $db->nodeshamspangen;
$collection = $db->testingnode;
$cursor = $collection->find();

$todayExists = false;

foreach($cursor as $doc){
//echo $doc["FIELD1"];
//echo $today;

if($doc["FIELD1"]==$today){ 
$todayExists = true;
$collection->update(array("_id"=> $doc["_id"]), array('$set'=>array("FIELD2"=>$str)));
}
}

if($todayExists==false){
$document= array(FIELD1=>$today, FIELD2=>$str, FIELD3=>"null", FIELD4=> "null", FIELD5=> "null");
$collection-> insert($document);
$todayExists=true;
}


?>
