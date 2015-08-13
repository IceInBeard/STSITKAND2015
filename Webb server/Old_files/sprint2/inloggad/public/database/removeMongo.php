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


$id = $_POST["id"];
$action = $_POST["action"];

$data = array();	   
	
    foreach ($cursor1 as $document) {
    array_push($data, $document);
}


foreach($cursor1 as $variable) {

if($action == "removeIssue"){	
$collection1->remove(array('_id' => new MongoId($id)));	
}
}


echo json_encode($data);
print $data;
