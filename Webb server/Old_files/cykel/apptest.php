<?php

echo "Start";
 
// check for required fields
//if (isset($_POST['user_id'])) {
 
    //$id = $_POST['user_id'];   
$id = 54545;
$m = new MongoClient();
    
$db = $m->issuereport;
$collection = $db->report;
echo "Collection selected successfully";
    
$document = array(
"user_id" => $id
);
$collection->insert($document);
echo "Document inserted successfully";
 
//} 
//else {
//	echo "Wrong with input to name";
//}

?>
