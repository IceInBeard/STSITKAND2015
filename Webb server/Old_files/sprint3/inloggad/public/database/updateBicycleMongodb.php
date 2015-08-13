<?php
   header('Content-type: text/plain; charset=utf-8');
   try {
   $m = new MongoClient();
   }

   catch (MongoException $ex) {
  
 }
//-------verkstad, parkering och pump----------//


$id = $_POST["id"];
$name = $_POST["name"];
$latitude = $_POST["latitude"];
$longitude = $_POST["longitude"];
$description = $_POST["description"];
$email = $_POST["email"];
$phoneNumber = $_POST["phoneNumber"];
$address = $_POST["address"];
$website = $_POST["website"];
$monday = $_POST["monday"];
$tuesday = $_POST["tuesday"];
$wednesday = $_POST["wednesday"];
$thursday = $_POST["thursday"];
$friday = $_POST["friday"];
$saturday = $_POST["saturday"];
$sunday = $_POST["sunday"];
$amount = $_POST["amount"];

$coordinates = array($longitude,$latitude);


$action = $_POST["action"];


$db = $m->bicycle;
   
   
$collection1 = $db->shop_update;
$cursor1 = $collection1->find();

$collection2 = $db->pump;
$cursor2 = $collection2->find();

$collection3 = $db->parking;
$cursor3 = $collection3->find();
//echo $action;
//foreach($cursor1 as $variable) {

	if($action == "updateVerkstad"){

		$collection1->update(array("_id"=> new Mongoid($id)), array('$set'=>array("name"=>$name)));
		$collection1->update(array("_id"=> new Mongoid($id)), array('$set'=>array("phoneNumber"=>$phoneNumber)));
		$collection1->update(array("_id"=> new Mongoid($id)), array('$set'=>array("address"=>$address)));
		$collection1->update(array("_id"=> new Mongoid($id)), array('$set'=>array("email"=>$email)));
		$collection1->update(array("_id"=> new Mongoid($id)), array('$set'=>array("website"=>$website)));
		$collection1->update(array("_id"=> new Mongoid($id)), array('$set'=>array("latitude"=>$latitude)));
		$collection1->update(array("_id"=> new Mongoid($id)), array('$set'=>array("longitude"=>$longitude)));
		$collection1->update(array("_id"=> new Mongoid($id)), array('$set'=>array("timeOpen" => array("monday" => $monday, "tuesday" => $tuesday, "wednesday" => $wednesday, "thursday" => $thursday, "friday" => $friday, "saturday" => $saturday, "sunday" => $sunday))));


//		$collection1->update(array("name"=> new Mongoid($id)), array('$set'=>array("address"=>$address)));
//		$collection1->update(array("name"=> new Mongoid($id)), array('$set'=>array("address"=>$address)));
//		$collection1->update(array("name"=> new Mongoid($id)), array('$set'=>array("address"=>$address)));
//		$collection1->update(array("name"=> new Mongoid($id)), array('$set'=>array("address"=>$address)));
//		$collection1->update(array("name"=> new Mongoid($id)), array('$set'=>array("address"=>$address)));

		
//	}
	
}
	if($action == "updatePump"){

		$collection2->update(array("_id"=> new Mongoid($id)), array('$set'=>array("name"=>$name)));
		$collection2->update(array("_id"=> new Mongoid($id)), array('$set'=>array("latitude"=>$latitude)));
		$collection2->update(array("_id"=> new Mongoid($id)), array('$set'=>array("longitude"=>$longitude)));
}

	if($action == "updateParking"){
echo "insideUpdateParking";
echo $coordinates;
		$collection3->update(array("_id"=> new Mongoid($id)), array('$set'=>array("GATA_OMR\u00c5DE"=>$adress)));
		$collection3->update(array("_id"=> new Mongoid($id)), array('$set'=>array("PLATSER"=>$amount)));
		$collection3->update(array("_id"=> new Mongoid($id)), array('$set'=>array("json_geometry.coordinates"=>$coordinates)));

}
/*foreach($cursor1 as $variable) {
	
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

	
}*/









?>
