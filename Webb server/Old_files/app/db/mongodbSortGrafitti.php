<?php
   header('Content-type: text/plain; charset=utf-8');
   try {
   $m = new MongoClient();
   }

   catch (MongoException $ex) {
 
  
 }
   



$category = $_POST["category"];
$comment = $_POST["comment"];
$comp = $_POST["comp"];
$descrip = $_POST["descrip"];
$email = $_POST["email"];
$group = $_POST["group"];
$id = $_POST["id"];
$latitude = $_POST["latitude"];
$longitude = $_POST["longitude"];
$name = $_POST["name"];
$picture = $_POST["picture"];
$status = $_POST["status"];
$timestamp = $_POST["timestamp"];
  
$action = $_POST["action"];
	
   
$db = $m->issuereporting;
   
   
$collection1 = $db->report;

   $cursor1 = $collection1->find(array('Category' => "Klotter"));

$collection2 = $db->companies;

   $cursor2 = $collection2->find(array('Category' => "Klotter"));


$cursor1->sort(array('Timestamp' => -1));
$cursor2->sort(array('Timestamp' => -1));


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
//$collection1->update(array("_id"=> new Mongoid($id)), array('$set'=>array("Name"=>$name)));
$collection1->update(array("_id"=> new Mongoid($id)), array('$set'=>array("Status_muni"=>$status)));
//$collection1->update(array("_id"=> new Mongoid($id)), array('$set'=>array("timestamp"=>$timestamp)));

	
}

	
    
}

if($action == "getComp"){ 
    $data = array();
  
    foreach ($cursor2 as $document) {

	array_push($data, $document);
    }

}

else {
    $data = array();	   
	
    foreach ($cursor1 as $document) {

	array_push($data, $document);
    }
}
/*
foreach($cursor2 as $variable2) {

if($action == "createCompany"){

$document= array(Name=> "Emil Entreprenad", OrgNumber=> "1112-0987", GeoArea=> "Luthagen", Category=> ["Vägar", "Cykel", "Trafik"], Contact=> "Emil Svensson", Email=> "emil@svensson.se", Phone=> "018-12345", CompanyId=> 2);
}


}
$collection2-> insert($document);

*/

echo json_encode($data);


