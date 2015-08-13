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

   $cursor1 = $collection1->find();

$collection2 = $db->companies;

   $cursor2 = $collection2->find();

   

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
$collection1->update(array("_id"=> new Mongoid($id)), array('$set'=>array("Comment"=>$comment)));			
$collection1->update(array("_id"=> new Mongoid($id)), array('$set'=>array("Comp"=>$comp)));
$collection1->update(array("_id"=> new Mongoid($id)), array('$set'=>array("Descrip"=>$descrip)));
$collection1->update(array("_id"=> new Mongoid($id)), array('$set'=>array("email"=>$email)));
$collection1->update(array("_id"=> new Mongoid($id)), array('$set'=>array("group"=>$group)));
$collection1->update(array("_id"=> new Mongoid($id)), array('$set'=>array("id"=>$id)));
$collection1->update(array("_id"=> new Mongoid($id)), array('$set'=>array("name"=>$name)));
$collection1->update(array("_id"=> new Mongoid($id)), array('$set'=>array("Status"=>$status)));
$collection1->update(array("_id"=> new Mongoid($id)), array('$set'=>array("timestamp"=>$timestamp)));
$collection1->update(array("_id"=> new Mongoid($id)), array('$set'=>array("action"=>$action)));


	
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


if($action == "createCompany"){	
$collection2->insert({Name: $name, org_num: $orgNumber});	
}
 




echo json_encode($data);


