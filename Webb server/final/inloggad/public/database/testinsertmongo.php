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

$action= "";


foreach($cursor2 as $variable) {

if($action == "createCompany"){

$document= array(Name=> "Erik Entreprenad", OrgNumber=> "1112-0987", GeoArea=> "Luthagen", Category=> ["Vägar", "Cykel", "Trafik"], Contact=> "Emil Svensson", Email=> "emil@svensson.se", Phone=> "018-12345", CompanyId=> 2);
}


}
$collection2-> insert($document);

$data = array();	   
	
    foreach ($cursor2 as $document) {
   
	array_push($data, $document);
    }

echo json_encode($data);


