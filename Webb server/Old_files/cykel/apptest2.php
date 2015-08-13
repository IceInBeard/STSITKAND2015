<?php

echo "Start";
$m = new MongoClient();

if (isset($_POST['user_id'])) {
 
    $id = $_POST['user_id']; 
//$id = 54545;

$db = $m->issuereport;
$collection = $db->report;
echo "Collection selected successfully";
$document = array("user_id" => $id);

$collection->insert($document);

echo "Document inserted successfully";

echo $id;

}else{
echo "Missing input";
}


?>
