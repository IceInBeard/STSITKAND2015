<?php
//echo "Cykel dev sida";

/**
 * Created by PhpStorm.
 * User: MajaEngvall
 * Date: 15-04-12
 * Time: 19:04
 */

header('Content-type: text/plain; charset=utf-8');
$db_host = "localhost";
$username = "cykel";
$password = "cykel";
$db_name = "cykel";

// Create connection
$conn = new mysqli($db_host, $username, $password, $db_name);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

//echo "Connected successfully";

$sql = "SELECT pump_id, pump_list_latitude, pump_list_longitude, pump_list_name FROM PUMP";
$result = $conn->query($sql);

$shops = [];
$pumps = array();


if ($result->num_rows > 0) {
    // output data of each row
	//$i = 0;
    while($row = $result->fetch_assoc()) {
	array_push($pumps, array_values($row));
	//$pumps[$i] = [$row["pump_id"], $row["pump_list_name"], $row["pump_list_latitude"], $row["pump_list_longitude"]];
        //echo "id: " . $row["pump_id"]. " - Name: " . $row["pump_list_name"]. "<br>";
	//$i=$i+1;
    }
} else {
    echo "0 results";
}

echo  json_encode($pumps);
$conn->close();

//include 'map.html';
//include 'pump.js';


?>
