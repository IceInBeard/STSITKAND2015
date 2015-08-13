<?php
include_once 'db_connect.php';
include_once 'psl-config.php';


$error_msg = "";

if (isset($_POST['username'], $_POST['email'],  $_POST['admin'],  $_POST['id'])) {
    // Sanitize and validate the data passed in
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $email = filter_var($email, FILTER_VALIDATE_EMAIL);
    $admin = (int) $_POST['admin'];
    $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);
    

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Not a valid email
        $error_msg .= '<p class="error">E-postadressen är inte gilig.</p>';
    }


    if ($insert_stmt = $mysqli->prepare("UPDATE members

        SET username= ?, email= ? , admin= ?     WHERE id= ?")) {
            $insert_stmt->bind_param('ssss', $username, $email, $admin, $id);

            // Execute the prepared query.
            if (! $insert_stmt->execute()) {
                header('Location: ../public/error.php?err=Update error: UPDATE');
            }
        }
        
         header('Location: ../public/success.php?success=Du du har uppdaterat användare '.$email.'&back=listUsers.php');


        }




function getUser($mysqli, $id){


	$prep_stmt = "SELECT username, email, admin FROM members WHERE id = ? LIMIT 1";
	
    $stmt = $mysqli->stmt_init();
    $stmt = $mysqli->prepare($prep_stmt);

    
   // check existing email  
    if ($stmt) {
        $stmt->bind_param('s', $id);
        $stmt->execute();
       //$stmt->store_result();

        $result = $stmt->get_result();

        
        $stmt->close();

    } else {
        $error_msg .= '<p class="error">Database error Line 39</p>';
                $stmt->close();
    }

    return $result->fetch_assoc();
}



?>