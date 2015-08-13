<?php
   require "../phpincludes/phputil.php";
   require "../phpincludes/plotupdate.php";
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
   $collection = $db->nodesdaghammar;
   $collection2 = $db->nodeshamspangen;
   $collection3 = $db->nodesresecentrum;

   //echo "Collection selected succsessfully"."\n";
   $cursor = $collection->find();
   $cursor->sort(array('FIELD2' => 1, 'age' => -1));
   $cursor2 = $collection2->find();
   $cursor3 = $collection3->find();
	$datahold = array();
	$datahold2= array();
	$datahold3 = array();

   // iterate cursor to display title of documents
   foreach ($cursor as $document) {
	$temp=array('FIELD1'=>$document['FIELD2'], 'FIELD2'=>$document['FIELD5'] + $document['FIELD6']);      
//echo $document["verkstad"][0]["name"] . "\n";
	array_push($datahold, $temp);
   }
   foreach ($cursor2 as $document2) {
   	array_push($datahold2, $document2);
   }
   foreach ($cursor3 as $document3) {
	array_push($datahold3, $document3); 
   }

$bikers = array();
//echo json_encode($datahold2);
$data["nodesdaghammar"] =$datahold;
$data["nodeshamspangen"]=$datahold2;
//echo 'Dagge :';
//echo '<br>';
//echo json_encode($datahold);
//echo 'hamnspang :';
//echo '<br>';
//echo json_encode($datahold2);
$data["nodesresecentrum"]=array_slice($datahold3,1);
foreach($data as $node){
	if ($node == $data["nodeshamspangen"]) {
		$temp=array();
		foreach($node as $point){
		
		$temp[$point['FIELD1']]=$point['FIELD2'];	
	}
		array_push($bikers,$temp);
	}
	else {
		array_push($bikers,dateGrouper($node,'FIELD1','FIELD2'));
	}
	//echo json_encode($bikers);
}

$paramarray= array();
$paramarray["un"]="MajaEngvall";
$paramarray["key"]="yeea6i8qtf";
$paramarray["filename"]='"hamnspangen"';
$paramarray["title"]='"Cykelflöde Dag H."';
$paramarray["yaxis"]='"Resecentrum"';
$paramarray["yaxis-title"]='"Antal cyklar"';
$paramarray["xaxis-title"]='"Datum"';
uppdateplotly(array_slice($bikers[0],-90),$paramarray);
$paramarray["filename"]='"nod_hamnspangen"';
$paramarray["title"]='"Cykelflöde Hamnspången."';
uppdateplotly(array_slice($bikers[1],-90),$paramarray);
$paramarray["filename"]='"nod_resecentrum"';
$paramarray["title"]='"Cykelflöde Resecentrum"';
uppdateplotly(array_slice($bikers[2],-90),$paramarray);

//var_dump(addDateGroups($bikers));
echo json_encode($bikers);






