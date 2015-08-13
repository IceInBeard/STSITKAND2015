<?php
include_once 'db_connect.php';
include_once 'psl-config.php';
 
$error_msg = "";
    
if (isset($_POST['email'])) {
    // Sanitize and validate the data passed in
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $email = filter_var($email, FILTER_VALIDATE_EMAIL);


    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Not a valid email
        $error_msg .= '<p class="error">E-postadressen är inte giltig.</p>';
    }

    $prep_stmt = "SELECT id FROM members WHERE email = ? LIMIT 1";
    $stmt = $mysqli->prepare($prep_stmt);
 
   // check existing email  
    if ($stmt) {
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $stmt->store_result();
 
        if ($stmt->num_rows == 0) {
            // A user with this email address already exists
            $error_msg .= '<p class="error">Det finns ingen användare med den E-postadressen</p>';
                        $stmt->close();
        }
                $stmt->close();
    } else {
        $error_msg .= '<p class="error">Database error Line 39</p>';
                $stmt->close();
    }


    if (empty($error_msg)) {


 
        // Insert the new user into the database 
        if ($insert_stmt = $mysqli->prepare("DELETE FROM members WHERE email=?")) {
            $insert_stmt->bind_param('s', $email);
            // Execute the prepared query.
            if (! $insert_stmt->execute()) {
                header('Location: ../public/error.php?err=Registration failure: INSERT');
            }
        }
        
         header('Location: ../public/deleteSuccess.php'); 
    }
}
