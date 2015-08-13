<?php
   header('Content-type: text/plain; charset=utf-8');
   try {
   $m = new MongoClient();
   }

   catch (MongoException $ex) {
 
  
 }
	
//----------------------REMOVE FROM MONGO--------------------
$db = $m->bicycle;
   
  
$collection1 = $db->shop_update;
	$cursor1 = $collection1->find();

$collection2 = $db->pump;
	$cursor2 = $collection2->find();

$collection3 = $db->parking;
	$cursor3 = $collection3->find();

$id = $_POST["id"];
$action = $_POST["action"];

$data = array();	   
	
    foreach ($cursor1 as $document) {
    array_push($data, $document);
}




if($action == "removeShop"){	
$collection1->remove(array('_id' => new MongoId($id)));	
}

if($action == "removePump"){	
$collection2->remove(array('_id' => new MongoId($id)));	
}

if($action == "removeParking"){	
$collection3->remove(array('_id' => new MongoId($id)));	
}



echo json_encode($data);
?>
