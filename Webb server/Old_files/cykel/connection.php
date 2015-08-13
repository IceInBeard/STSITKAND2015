<?php
/**
 * Created by PhpStorm.
 * User: MajaEngvall
 * Date: 15-04-12
 * Time: 19:04
 */

$db_host = "localhost";
$username = "root";
$password = "sts";
$db_name = "cykel";

echo "hi";

// Create connection
@mysql_connect("$db_host","$username","$password") or die ("Could not connect to MySql");
@mysql_select_db("$db_name") or die ("No Database");
//$conn = new mysqli($servername, $username, $password);

// Check connection
//if ($conn->connect_error) {
//    die("Connection failed: " . $conn->connect_error);
//}
echo "Connected successfully";
?>
