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
$collection2 = $db->nodesdaghammar;
$cursor = $collection->find();
$cursor2 = $collection2->find();
	$datahold = array();

   foreach ($cursor as $document) {
	if($document["FIELD1"]==$today){ 
	array_push($datahold, $document['FIELD2']);
	

}
   }
foreach ($cursor2 as $document) {
   	
	if($document["FIELD2"]==$today.' 00:01:00'){ 
	array_push($datahold, $document["FIELD5"]+$document["FIELD6"]);
	
}
   }
$totalBikes = 0;
foreach ($datahold as $document) {
	
	$totalBikes = $totalBikes + intval($document);
}

echo $totalBikes;

?>
