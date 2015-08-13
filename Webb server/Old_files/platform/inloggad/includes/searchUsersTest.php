<?php
include_once 'db_connect.php';
include_once 'psl-config.php';

    if (isset($_POST['email'])) {
    // Sanitize and validate the data passed in

    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
    if ($email=="Namn eller E-mail"){
        $email='';
    }
    $email= $email. "%";

    }

    $text = '';

 


    $prep_stmt = "SELECT id, username, admin, email FROM members WHERE email LIKE '?';";
    $stmt = $mysqli->prepare($prep_stmt);

   // check existing email  
    if ($stmt) {
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $stmt->store_result();
 
        
                
    } else {
        $error_msg .= '<p class="error">Database error Line 39</p>';
                $stmt->close();
    }





   
    // Search the database

    if (mysqli_num_rows($stmt) > 0) {
        // output data of each row
        $text.="<table class='user-meny'> <tr class='user-meny'> 
        <th class='user-meny'>Id</th> 
        <th class='user-meny'>Namn</th>
        <th class='user-meny'>E-post</th>
        <th class='user-meny'>Admin</th>
        </tr> ";
        while($row = mysqli_fetch_assoc($stmt)) {
            $text.="<tr class='user-meny'> <td class='user-meny'>    " . $row["id"]. "</td>
            <td class='user-meny'>    " . $row["username"].  "</td>
            <td class='user-meny'>    " . $row["email"]. "</td>";
        
            if($row["admin"]=='1'){ 
                $text.="<td class='user-meny'>Ja</td></tr>"; } 

            else { 
                $text.="<td class='user-meny'>Nej</td></tr>"; } 
        
        }
        $text.="</table>";
    } else {
        $text.="0 results";
    }

    $stmt->close();



?>
