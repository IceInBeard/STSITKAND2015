<?php
   header('Content-type: text/plain; charset=utf-8');
   try {
   $m = new MongoClient();
   }

   catch (MongoException $ex) {
    //echo "error message: ".$ex->getMessage()."\n";
   }
   //echo "Connection to database successfully"."\n";
   // select a database
   $db = $m->bicycle;
   //echo "Database bicycle selected"."\n";
   $collection = $db->node;

   //echo "Collection selected succsessfully"."\n";
   $cursor = $collection->find();

	$datahold = array();
	$datahold2=array();
   // iterate cursor to display title of documents
   foreach ($cursor as $document) {
      
	array_push($datahold, $document);
   }


//$data = array();
$data["nodes"] = $datahold;



echo json_encode($data);



?>
