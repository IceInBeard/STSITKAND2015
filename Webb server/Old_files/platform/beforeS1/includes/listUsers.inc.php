<?php
include_once "db_connect.php";
include_once "psl-config.php";
include_once "../public/header.php";


function listUsers() {
    // Create connection
    $conn = mysqli_connect(HOST, USER, PASSWORD, DATABASE);
    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "SELECT id, username, admin, email FROM members";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        echo '<table> <tr> 
        <th>Id</th> 
        <th>Namn</th>
        <th>E-post</th>
        <th>Admin</th>
        </tr> ';
        while($row = mysqli_fetch_assoc($result)) {
            echo "<tr> <td>    " . $row["id"]. "</td>
            <td>    " . $row["username"].  "</td>
            <td>    " . $row["email"]. "</td>";
        
            if($row["admin"]=='1'){ 
                echo "<td>Ja</td></tr>"; } 

            else { 
                echo "<td>Nej</td></tr>"; } 
        
        }
        echo "</table>";
    } else {
        echo "0 results";
    }

    mysqli_close($conn);
    }

?>