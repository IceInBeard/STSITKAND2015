<?php

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
$collection = $db->testingnode;//byt ut till rätt colelction senare
$cursor = $collection->find();
	$datahold = array();
//echo "4251";
   foreach ($cursor as $document) {
//   	echo "heeeeeej";
	if($document["FIELD1"]==$today){ 
	array_push($datahold, $document);

}
   }
echo ($document["FIELD2"]);
?>
