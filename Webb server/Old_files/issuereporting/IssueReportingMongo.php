<?php
   header('Content-type: text/html; charset=utf-8');
   try {
   $m = new MongoClient();
   }

   catch (MongoException $ex) {
    //echo "error message: ".$ex->getMessage()."\n";
   }
   
   $db = $m->issuereporting;
  
   $collection = $db->report;
 
   $cursor = $collection->find();
  
 // iterate cursor to display title of documents
	$data = array();	   
	foreach ($cursor as $document) {
      
	array_push($data, $document);
   }


echo json_encode($data);
