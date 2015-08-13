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


$name = $_POST["name"];
$userId = $_POST["userId"];
$area = $_POST["area"];
$email = $_POST["email"];
$categories = $_POST["categories"];

$action = $_POST["action"];

if($action == "createCompany"){
$newDocument= array("Name"=> $name, "CompanyId" => $userId, "GeoArea"=> $area, "Category"=> [$categories], "Email"=> $email);
}

$collection2-> insert($newDocument);

$data = array();
  
    foreach ($cursor2 as $document) {
	array_push($data, $document);
    }

echo json_encode($data);
//print $data;
?>


