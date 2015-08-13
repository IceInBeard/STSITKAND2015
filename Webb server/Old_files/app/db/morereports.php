<?php
   header('Content-type: text/plain; charset=utf-8');
   try {
   $m = new MongoClient();
   }

   catch (MongoException $ex) {
 
  
 }

$db = $m->issuereporting;
$collection1 = $db->report;
$cursor1 = $collection1->find();


$cursor1->sort(array('Timestamp' => -1));

$action = $_POST['Action'];
$startFromIdx = $_POST['updateIndex'];
$startFromIdxInt = (int)$startFromIdx;
$cursor1->skip($startFromIdxInt);
if($action == 'moreReports'){
	$data = array();
	$i = 0;	
	foreach($cursor1 as $document) {
		
		array_push($data, $document);
		$i++;
		if($i == 10){
			break;
		}
	}
echo json_encode($data);			

}
