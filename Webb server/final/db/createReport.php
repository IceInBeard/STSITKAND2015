<?php
// MONGODB

   header('Content-type: text/plain; charset=utf-8');
   try {
   $m = new MongoClient();
   }

   catch (MongoException $ex) {
 }

$newIssueId = new MongoId();

//PIC UPLOAD

$target_dir = "/var/www/final/issuePictures/";
//$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);

//$id = "kanel";
$temp = explode(".",$_FILES["fileToUpload"]["name"]);
$newfilename = $newIssueId . '.' .end($temp);

$target_file = $target_dir . $newfilename;
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

// Check if image file is a actual image or fake image

    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "Filen du försöker ladda upp är inte en bild.";
        $uploadOk = 0;
    }

// Check file size
if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Bilden du försöker ladda upp är för stor.";
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    echo "Endast JPG, JPEG, PNG & GIF filer är tillåtna.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Bilden laddades inte upp.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        echo "Uppladdning klar!<br>";
        echo "Skicka bild-plats till databas". basename( $_FILES["fileToUpload"]["name"]). "";
	$picname = basename( $_FILES["fileToUpload"]["name"]);
    } else {
        echo "Ett fel inträffade och bilden laddades inte upp.";
    }
}

date_default_timezone_set("Europe/Stockholm");
$date ="" . date("Y-m-d H:i:s") . "";




$category = $_POST["issueCategory"];
$descrip = $_POST["widgetDescription"];
$latitude = $_POST["droppedLat"];
$longitude = $_POST["droppedLng"];
//$action = $_POST["action"];
$picture = $_FILES["fileToUpload"];

	   
$picture = "/final/issuePictures/". $newfilename. "";

$db = $m->issuereporting; 
$collection = $db->report;
$cursor = $collection->find();

//if($action == "createReport"){ 
$newDocument= array("_id"=> $newIssueId,"Category"=> $category, "Comment_muni"=> "", "Comp_resp"=> "Välj företag", "Description"=> $descrip, "Group"=> "Issues","Latitude"=> $latitude,"Longitude"=> $longitude, "Picture"=> $picture,"Priority"=>"Nej","Status_muni"=> "Inrapporterad", "Timestamp"=> $date);
//}

$collection-> insert($newDocument);

$data = array();	   	
    foreach ($cursor as $document) {  
	array_push($data, $document);
    }
echo json_encode($data);

?> 
