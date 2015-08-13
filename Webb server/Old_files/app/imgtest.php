<?php
echo "imgtest";
if(isset($_POST['ImageName'])) {
$imgname = $_POST['ImageName'];
$imgsrc = base64_decode($_POST['base64']);
$fp = fopen($imgname,'w');
fwrite($fp,$imgsrc);
if(fclose($fp)) {
echo "Image Uploaded";
}
else {
echo "Error uploading image";
}
}
/*$m = new MongoClient();
$db = $m->imgtest;
$data = 'iVBORw0KGgoAAAANSUhEUgAAABwAAAASCAMAAAB/2U7WAAAABl'
       . 'BMVEUAAAD///+l2Z/dAAAASUlEQVR4XqWQUQoAIAxC2/0vXZDr'
       . 'EX4IJTRkb7lobNUStXsB0jIXIAMSsQnWlsV+wULF4Avk9fLq2r'
       . '8a5HSE35Q3eO2XP1A1wQkZSgETvDtKdQAAAABJRU5ErkJggg==';

if (isset($_POST['Image'])){
	$data = $_POST['Image'];

	$data = base64_decode($data);
	$im = imagecreatefromstring($data);

	if ($im !== false){

		header('Content-Type: image/png');
		imagepng($im);
		//imagedestroy($im);


	}
	else {
		echo 'An error occurred.';
	}

	
	//$collection = $db->img;
	$gridfs = $m->getGridFS();
	$gridfs->insert($ime, array('ImageType' => "PNG");
}else{}

*/

/*

$db = $m->test;
$gridfs = $db->getGridFs();

$gridfs = $m->selectDB('test')->getGridFS();
$gridfs->storeFile($source, array('Image' => $imgsrc);






$angle = 90;
$rotate = imagerotate($source, $angle, 0);
$imageName = "newImage.jpg";
$imageSave = imagejpeg($rotate, $imageName, 100);



$db = $m->test;
$gridfs = $db->getGridFs();


    $gridfs = $m->selectDB('test')->getGridFS();
    $gridfs->storeFile($imageSave, array('Image' => $imgsrc);

*/

?>
