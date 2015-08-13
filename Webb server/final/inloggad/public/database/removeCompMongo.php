<?php
   header('Content-type: text/plain; charset=utf-8');
   try {
   $m = new MongoClient();
   }

   catch (MongoException $ex) {
 
  
 }
	
   
$db = $m->issuereporting;   
$collection1 = $db->companies;
$cursor1 = $collection1->find();


$id = $_POST["id"];


foreach($cursor1 as $variable) {


$collection1->remove(array('_id' => new MongoId($id)));	

}


echo "Company Removed";
?>
