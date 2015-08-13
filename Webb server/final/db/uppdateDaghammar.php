
<?php

$url =  'https://liveapi.edeva.se/v1/gccounters/2/get-daily-counters';

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);

//Gives us the result of Curl back in the return variable
curl_setopt($ch, CURLOPT_RETURNTRANSFER , TRUE);
curl_setopt($ch, CURLOPT_USERAGENT , 'Mozilla/5.0 (Windows; U; Windows NT 5.1; pl; rv:1.9) Gecko/2008052906 Firefox/3.0');
//Do not include the header data in the result
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Authorization:Bearer ATG3tjF1nPDwIm53VBBva4OWLwSc', 'Content-Type: application/json']);

//Uncomment row below for deb printout
//curl_setopt($ch, CURLOPT_VERBOSE, '1');

$result = curl_exec($ch);

/** @var array $returnInfo Find the info of the returned curl call */
$returnInfo = curl_getinfo($ch);
$jsonArray = json_decode($result, true);
curl_close($ch);
$today = date("Y-m-d") . " 00:01:00" ;
//string gettype($today)
//------------------Koppling till vår mongoDB----------------//
   header('Content-type: text/plain; charset=utf-8');
   try {
   $m = new MongoClient();
   }

   catch (MongoException $ex) {
 
  
 }

$db = $m->bicycle;

$collection = $db->nodesdaghammar;
$cursor = $collection->find();

$todayExists = false;
if (intval($jsonArray['bin'])+intval($jsonArray['bout']!=0)) {
foreach($cursor as $doc){

if($doc["FIELD2"]==$today){ 
$todayExists = true;
$collection->update(array("_id"=> $doc["_id"]), array('$set'=>array("FIELD5"=>intval($jsonArray['bin']), "FIELD6"=>intval($jsonArray['bout']))));
}
}

if($todayExists==false){
$document= array(FIELD1=>"null", FIELD2=>$today, FIELD3=>"null", FIELD4=> "null", FIELD5=> intval($jsonArray['bin']), FIELD6=>intval($jsonArray['bout']));
$collection-> insert($document);
$todayExists=true;
}
}


?>
