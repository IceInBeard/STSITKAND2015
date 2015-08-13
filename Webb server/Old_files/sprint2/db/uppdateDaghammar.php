
<?php


$s= shell_exec('curl -i -H "Authorization:  Bearer ATG3tjF1nPDwIm53VBBva4OWLwSc" "https://liveapi.edeva.se/v1/gccounters/2/find-after/1431338281"');
echo $s;//Detta är all data vi får när vi kör shell_exec
$start = strpos($s, "[");
$end = $s.length;

$result = substr($s, $start+1, $end-1);
//print_r (explode("{",$result));
//$arr =(array) json_decode($result, true);

echo json_encode($result); //Detta är då vi kör json_encod, men det blir konstigt rsultat...
echo $result; //detta är resultatet vi får när vi har tagit bort den data som inte ser ut som ett json

//------------------Koppling till vår mongoDB----------------//
   header('Content-type: text/plain; charset=utf-8');
   try {
   $m = new MongoClient();
   }

   catch (MongoException $ex) {
 
  
 }

$db = $m->bicycle;

$collection = $db->testdaghammar;
$cursor = $collection->find();
//$collection->insert(array($result));



$cursor = $collection->find();


?>
