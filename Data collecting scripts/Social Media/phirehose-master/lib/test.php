#!/usr/bin/php -q

<?php
/*$myArray = array('GGIK', 'Brynas','Huge','Hille');
$myJson = json_encode($myArray);
print $myJson . "\n";
$myFile = fopen("newfile.json", "a");
fwrite($myFile, $myJson);
fclose($myFile);*/
$myArray = array('Gustav', 'Alma', 'Ulrika','Jan');
$myJson = json_encode($myArray);
echo $myArray;
echo $myJson;



?>