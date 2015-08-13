<?php
   header('Content-type: text/plain; charset=utf-8');
   try {
   $m = new MongoClient();
   }

   catch (MongoException $ex) {
 
  
 }
	
   
$db = $m->issuereporting;   
$collection2 = $db->companies;
$cursor2 = $collection2->find();


$data = array();
  
    foreach ($cursor2 as $document) {
   
	array_push($data, $document);
    }



echo json_encode($data);
print $data;


