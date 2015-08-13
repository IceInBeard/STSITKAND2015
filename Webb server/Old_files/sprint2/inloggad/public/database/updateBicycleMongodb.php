<?php
   header('Content-type: text/plain; charset=utf-8');
   try {
   $m = new MongoClient();
   }

   catch (MongoException $ex) {
 
  
 }
//-------verkstad, parkering och pump----------//
$name = $_POST["name"];
$latitude = $_POST["latitude"];
$longitude = $_POST["longitude"];
$description = $_POST["description"];
$email = $_POST["email"];
$phoneNumber = $_POST["phoneNumber"];
$id = $_POST["id"];
$address = $_POST["address"];
$website = $_POST["website"];
$timeopen = $_POST["timeopen"];

$amountParking = $_POST["amountParking"];

$action = $_POST["action"];



$db = $m->bicycle;
   
   
$collection1 = $db->shop;

   $cursor1 = $collection1->find();

$collection2 = $db->pump;

   $cursor2 = $collection2->find();

$collection3 = $db->parking;

   $cursor3 = $collection3->find();


foreach($cursor1 as $variable) {
	
if($action == "changeStatus"){	
$collection1->update(array("_id"=> new Mongoid($id)), array('$set'=>array("Status_muni"=>$status)));	
}
if($action == "changeCategory"){	
$collection1->update(array("_id"=> new Mongoid($id)), array('$set'=>array("Category"=>$category)));	
}
if($action == "changeComment"){	
$collection1->update(array("_id"=> new Mongoid($id)), array('$set'=>array("Comment_muni"=>$comment)));	
}
if($action == "changeComp"){	
$collection1->update(array("_id"=> new Mongoid($id)), array('$set'=>array("Comp_resp"=>$comp)));	
}




if($action == "changeAll"){	

$collection1->update(array("_id"=> new Mongoid($id)), array('$set'=>array("Category"=>$category)));
$collection1->update(array("_id"=> new Mongoid($id)), array('$set'=>array("Comment_muni"=>$comment)));			
$collection1->update(array("_id"=> new Mongoid($id)), array('$set'=>array("Comp_resp"=>$comp)));
$collection1->update(array("_id"=> new Mongoid($id)), array('$set'=>array("Description"=>$descrip)));
$collection1->update(array("_id"=> new Mongoid($id)), array('$set'=>array("Email"=>$email)));
$collection1->update(array("_id"=> new Mongoid($id)), array('$set'=>array("Name"=>$name)));
$collection1->update(array("_id"=> new Mongoid($id)), array('$set'=>array("Status_muni"=>$status)));
//$collection1->update(array("_id"=> new Mongoid($id)), array('$set'=>array("timestamp"=>$timestamp)));

	
}









?>
