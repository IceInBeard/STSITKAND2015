<?php
 
$DB_USER = "issuereporting";
$DB_PASSWORD = "issuereporting";
$DB_DATABASE = "issuereporting";
$DB_SERVER = "localhost";


// array for JSON response
$response = array();


 
// check for required fields
if (isset($_POST['Longitude'] && )) {
 
    $id = $_POST['user_id'];   

    $conn = new mysqli($DB_SERVER, $DB_USER, $DB_PASSWORD, $DB_DATABASE);

    if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
    }
 
    // mysql inserting a new row
    $sql= "INSERT INTO `report`
(`ID`, `Category`, `Longitude`, `Latitude`, `Timestamp`, 
`Status`, `Pers_name`, `Pers_email`, `Description`, `Picture`) VALUES 
(NULL, 'lampor',17.6389270,59.8585640, current_timestam,(),NULL,'selma','sel@gmail.com','sonder','bild1');";
 
    // check if row inserted or not
    if ($conn->query($sql) === TRUE) {
	echo "New record created successfully";
    } else {
	echo "Error: " . $sql . "<br>" . $conn->error;
    }
} 
else {
	echo "Wrong with input to name";
}

?>
