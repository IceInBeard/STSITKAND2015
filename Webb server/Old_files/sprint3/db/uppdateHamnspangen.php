
<?php


$s= shell_exec('curl -i -H "Authorization:  Bearer ATG3tjF1nPDwIm53VBBva4OWLwSc" "https://liveapi.edeva.se/v1/gccounters/2/find-after/1431338281"');
//echo json_encode($s);
$start = strpos($s, "[");

$end = $s.length;

$result = substr($s, $start+1, $end-1);


$arr =(array) json_decode($result, true);
echo $result;


   header('Content-type: text/plain; charset=utf-8');
   try {
   $m = new MongoClient();
   }

   catch (MongoException $ex) {
 
  
 }











/*/header('curl -i -H "Authorization:  Bearer ATG3tjF1nPDwIm53VBBva4OWLwSc" "https://liveapi.edeva.se/v1/gccounters/2/find-after/1410215400"');
// Get cURL resource
$curl = curl_init();

// Set some options - we are passing in a useragent too here
curl_setopt_array($curl, array(
        CURLOPT_RETURNTRANSFER => true,
	CURLOPT_HTTPHEADER => array('Authorization:  Bearer ATG3tjF1nPDwIm53VBBva4OWLwSc'),
        CURLOPT_URL => 'https://liveapi.edeva.se/v1/gccounters/2/find-after/1410215400',
	CURLINFO_HEADER_OUT => true,
        CURLOPT_POST => 1,
        CURLOPT_POSTFIELDS => $myData
    )
);

//curl_setopt($curl, CURLOPT_POST,       true);
curl_setopt($curl, CURLOPT_URL, 'https://liveapi.edeva.se/v1/gccounters/2/find-after/1410215400');
curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Bearer ATG3tjF1nPDwIm53VBBva4OWLwSc'));
//curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

// Send the request & save response to $resp
$resp = curl_exec($curl);

//echo curl_getinfo($resp);
//echo $resp;
// Close request to clear up some resources
curl_close($curl);

if($resp){echo $resp}
else{die(curl_error($curl))}*/



?>
