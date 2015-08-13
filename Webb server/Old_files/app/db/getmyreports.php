<?php
   header('Content-type: text/plain; charset=utf-8');
   try {
   $m = new MongoClient();
   }

   catch (MongoException $ex) {
 
  
 }

/// CHOOSE DATABASE, COLLECTION, GET ACTION ///

$db = $m->issuereporting;
$collection1 = $db->report;
$cursor1 = $collection1->find();

$action = $_POST['Action'];

/// CHECK AND LOAD NEARBY REPORTS ///

if($action=='getNearbyReports') {
	$data = array();

	$currentLat = $_POST['Latitude'];
	$currentLon = $_POST['Longitude'];

	foreach($cursor1 as $document) {

		if(distance($currentLat, $currentLon, $document["Latitude"], $document["Longitude"])){
   
			array_push($data, $document);
    		}
	}
	echo json_encode($data); 
}

/// LOAD OWN REPORTS ///

if($action=='getMyReports') {
	$data = array();
	$length = $_POST['Length'];
	$length_int = (int)$length;
	$idx = 0;
	while($idx<$length_int) {
		$id = $_POST[(string)$idx];
		foreach($cursor1 as $document) {
			if($id==$document['UniqueID']) {
				array_push($data, $document);
			}	
			
		}
		$idx++;
	}
	echo json_encode($data);
	
}

/// LOAD DATA ///

if($action == 'loadLatest'){

	$cursor1->sort(array('Timestamp' => -1));
	$cursor1->limit(10);

	$data = array();	   
	
    	foreach ($cursor1 as $document) {

		array_push($data, $document);
    	}
	echo json_encode($data);
}

if($action == 'loadBike'){
	$cursor1 = $collection1->find(array('Category' => "Cykel"));
	$cursor1->sort(array('Timestamp' => -1));
	$cursor1->limit(10);

	$data = array();	   
	
    	foreach ($cursor1 as $document) {

		array_push($data, $document);
    	}
	echo json_encode($data);
}

if($action == 'loadClean'){
	$cursor1 = $collection1->find(array('Category' => "Renhållning"));
	$cursor1->sort(array('Timestamp' => -1));
	$cursor1->limit(10);

	$data = array();	   
	
    	foreach ($cursor1 as $document) {

		array_push($data, $document);
    	}
	echo json_encode($data);
}

if($action == 'loadPublic'){
	$cursor1 = $collection1->find(array('Category' => "Allmänna platser"));
	$cursor1->sort(array('Timestamp' => -1));
	$cursor1->limit(10);

	$data = array();	   
	
    	foreach ($cursor1 as $document) {

		array_push($data, $document);
    	}
	echo json_encode($data);
}

if($action == 'loadOther'){
	$cursor1 = $collection1->find(array('Category' => "Övrigt"));
	$cursor1->sort(array('Timestamp' => -1));
	$cursor1->limit(10);

	$data = array();	   
	
    	foreach ($cursor1 as $document) {

		array_push($data, $document);
    	}
	echo json_encode($data);
}

if($action == 'loadRoad'){
	$cursor1 = $collection1->find(array('Category' => "Vägar"));
	$cursor1->sort(array('Timestamp' => -1));
	$cursor1->limit(10);

	$data = array();	   
	
    	foreach ($cursor1 as $document) {

		array_push($data, $document);
    	}
	echo json_encode($data);
}


if($action == 'loadVegetation'){
	$cursor1 = $collection1->find(array('Category' => "Vegetation"));
	$cursor1->sort(array('Timestamp' => -1));
	$cursor1->limit(10);

	$data = array();	   
	
    	foreach ($cursor1 as $document) {

		array_push($data, $document);
    	}
	echo json_encode($data);
}

if($action == 'loadTraffic'){
	$cursor1 = $collection1->find(array('Category' => "Trafik"));
	$cursor1->sort(array('Timestamp' => -1));
	$cursor1->limit(10);

	$data = array();	   
	
    	foreach ($cursor1 as $document) {

		array_push($data, $document);
    	}
	echo json_encode($data);
}

if($action == 'loadKlotter'){
	$cursor1 = $collection1->find(array('Category' => "Klotter"));
	$cursor1->sort(array('Timestamp' => -1));
	$cursor1->limit(10);

	$data = array();	   
	
    	foreach ($cursor1 as $document) {

		array_push($data, $document);
    	}
	echo json_encode($data);
}

/// LOAD MORE DATA ///

if($action == 'moreReports'){
	$cursor1->sort(array('Timestamp' => -1));
	$startFromIdx = $_POST['updateIndex'];
	$startFromIdxInt = (int)$startFromIdx;
	$cursor1->skip($startFromIdxInt);
	$data = array();
	$i = 0;	
	foreach($cursor1 as $document) {
		
		array_push($data, $document);
		$i++;
		if($i == 10){
			break;
		}
	}
	echo json_encode($data);			

}

if($action == 'moreBike'){
	$cursor1 = $collection1->find(array('Category' => "Cykel"));
	$cursor1->sort(array('Timestamp' => -1));
	$startFromIdx = $_POST['updateIndex'];
	$startFromIdxInt = (int)$startFromIdx;
	$cursor1->skip($startFromIdxInt);
	$data = array();
	$i = 0;	
	foreach($cursor1 as $document) {
		
		array_push($data, $document);
		$i++;
		if($i == 10){
			break;
		}
	}
	echo json_encode($data);			

}

if($action == 'moreClean'){
	$cursor1 = $collection1->find(array('Category' => "Renhållning"));
	$cursor1->sort(array('Timestamp' => -1));
	$startFromIdx = $_POST['updateIndex'];
	$startFromIdxInt = (int)$startFromIdx;
	$cursor1->skip($startFromIdxInt);
	$data = array();
	$i = 0;	
	foreach($cursor1 as $document) {
		
		array_push($data, $document);
		$i++;
		if($i == 10){
			break;
		}
	}
	echo json_encode($data);			

}

if($action == 'morePublic'){
	$cursor1 = $collection1->find(array('Category' => "Allmänna platser"));
	$cursor1->sort(array('Timestamp' => -1));
	$startFromIdx = $_POST['updateIndex'];
	$startFromIdxInt = (int)$startFromIdx;
	$cursor1->skip($startFromIdxInt);
	$data = array();
	$i = 0;	
	foreach($cursor1 as $document) {
		
		array_push($data, $document);
		$i++;
		if($i == 10){
			break;
		}
	}
	echo json_encode($data);			

}

if($action == 'moreOther'){
	$cursor1 = $collection1->find(array('Category' => "Övrigt"));
	$cursor1->sort(array('Timestamp' => -1));
	$startFromIdx = $_POST['updateIndex'];
	$startFromIdxInt = (int)$startFromIdx;
	$cursor1->skip($startFromIdxInt);
	$data = array();
	$i = 0;	
	foreach($cursor1 as $document) {
		
		array_push($data, $document);
		$i++;
		if($i == 10){
			break;
		}
	}
	echo json_encode($data);			

}

if($action == 'moreRoad'){
	$cursor1 = $collection1->find(array('Category' => "Vägar"));
	$cursor1->sort(array('Timestamp' => -1));
	$startFromIdx = $_POST['updateIndex'];
	$startFromIdxInt = (int)$startFromIdx;
	$cursor1->skip($startFromIdxInt);
	$data = array();
	$i = 0;	
	foreach($cursor1 as $document) {
		
		array_push($data, $document);
		$i++;
		if($i == 10){
			break;
		}
	}
	echo json_encode($data);			

}

if($action == 'moreVegetation'){
	$cursor1 = $collection1->find(array('Category' => "Vegetation"));
	$cursor1->sort(array('Timestamp' => -1));
	$startFromIdx = $_POST['updateIndex'];
	$startFromIdxInt = (int)$startFromIdx;
	$cursor1->skip($startFromIdxInt);
	$data = array();
	$i = 0;	
	foreach($cursor1 as $document) {
		
		array_push($data, $document);
		$i++;
		if($i == 10){
			break;
		}
	}
	echo json_encode($data);			

}

if($action == 'moreTraffic'){
	$cursor1 = $collection1->find(array('Category' => "Trafik"));
	$cursor1->sort(array('Timestamp' => -1));
	$startFromIdx = $_POST['updateIndex'];
	$startFromIdxInt = (int)$startFromIdx;
	$cursor1->skip($startFromIdxInt);
	$data = array();
	$i = 0;	
	foreach($cursor1 as $document) {
		
		array_push($data, $document);
		$i++;
		if($i == 10){
			break;
		}
	}
	echo json_encode($data);			

}

if($action == 'moreKlotter'){
	$cursor1 = $collection1->find(array('Category' => "Klotter"));
	$cursor1->sort(array('Timestamp' => -1));
	$startFromIdx = $_POST['updateIndex'];
	$startFromIdxInt = (int)$startFromIdx;
	$cursor1->skip($startFromIdxInt);
	$data = array();
	$i = 0;	
	foreach($cursor1 as $document) {
		
		array_push($data, $document);
		$i++;
		if($i == 10){
			break;
		}
	}
	echo json_encode($data);			

}



/// DISTANCE FUNCTION ///

function distance($lat1, $lon1, $lat2, $lon2){

	$theta = $lon1 - $lon2;

	$dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));

	$dist = acos($dist);

	$dist = rad2deg($dist);

	$km = $dist * 60 * 1.1515 * 1.609344;

	if ($km < 0.5){

		return TRUE;
	}else{
		return FALSE;}
}

