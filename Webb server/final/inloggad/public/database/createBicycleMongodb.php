<?php
   header('Content-type: text/plain; charset=utf-8');
   try {
   $m = new MongoClient();
   }

   catch (MongoException $ex) {
 
  
 }
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

$amountParking = $_POST["capacity"];

$action = $_POST["action"];
   
$db = $m->bicycle;
   
   
$collection1 = $db->shop_update;

$collection2 = $db->pump;

$collection3 = $db->parking;




if($action == "createPump"){
$newDocument= array("name"=> $name, "latitude" => $latitude, "longitude" => $longitude);
$collection2-> insert($newDocument);
}

if($action == "createVerkstad"){
$newDocument= array("name"=> $name, "latitude" => $latitude, "longitude" => $longitude, "timeOpen" => array("monday" => $monday, "tuesday" => $tuesday, "wednesday" => $wednesday, "thursday" => $thursday, "friday" => $friday, "saturday" => $saturday, "sunday" => $sunday),"description" => $description, "phoneNumber" => $phoneNumber, "address" => $address, "website" => $website, "email" => $email);
$collection1-> insert($newDocument);
}

if($action == "createParking"){
$newDocument= array( "GATA_OMRÅDE" => $address, "PLATSER" => $amountParking, "json_geometry" => array("type" => "Point", "coordinates" => array($latitude, $longitude)));
$collection3-> insert($newDocument);
}

?>


