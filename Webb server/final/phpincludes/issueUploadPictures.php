<?php
$target_dir = "/var/www/sprint3/issuePictures/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
        //echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
        echo "Filen du försöker ladda upp är inte en bild.";
        $uploadOk = 0;
    }
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
    } else {
        echo "Ett fel inträffade och bilden laddades inte upp.";
    }
}

date_default_timezone_set("Europe/Stockholm");
$date ="" . date("Y-m-d H:i:s") . "";
echo "<br><br>"; 
echo $date


?> 
