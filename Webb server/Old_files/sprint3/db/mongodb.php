
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
   $collection = $db->parking;
   $collection2 = $db->pump;
   $collection3 = $db->shop_update;
   //echo "Collection selected succsessfully"."\n";
   $cursor = $collection->find();
   $cursor2 = $collection2->find();
   $cursor3 = $collection3->find();
	$datahold = array();
	$datahold2=array();
	$datahold3=array();
   // iterate cursor to display title of documents
   foreach ($cursor as $document) {
      //echo $document["verkstad"][0]["name"] . "\n";
	array_push($datahold, $document);
   }
   foreach ($cursor2 as $document2) {
   array_push($datahold2, $document2);
   }
   foreach ($cursor3 as $document3) {
    array_push($datahold3, $document3);
   }
//echo $data["0"]["id"];
//$data = array();
$data["parking"] = $datahold;
$data["verkstad"]=$datahold3;
$data["pump"]=$datahold2;


echo json_encode($data);

//to get coordinates from parking, result is represented [17.56567 , 59.87679]
//echo json_encode($data["parking"][0]["json_geometry"]["coordinates"]);


?>


