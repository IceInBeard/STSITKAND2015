<!-- This is the include file used by ../public/deleteServiceMessage.php to connect to the database and delete a service message -->

<?php
include_once 'db_connect.php';
include_once 'psl-config.php';
 
$error_msg = "";

//Get the variable entered in the form at ../public/deleteServiceMessage.php
if (isset($_POST['title'])) {
    // Sanitize and validate the data passed in
    $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);

    

    //Check that the title entered exists on a message in the database. 
    $prep_stmt = "SELECT id FROM s_message WHERE title = ? LIMIT 1";
    $stmt = $mysqli->prepare($prep_stmt);
 
   // check existing title 
    if ($stmt) {
        $stmt->bind_param('s', $title);
        $stmt->execute();
        $stmt->store_result();
 
        if ($stmt->num_rows == 0) {
            $error_msg .= '<p class="error">Det finns inget servicemeddelande med den titeln</p>';
                        $stmt->close();
        }
                $stmt->close();
    } else {
        $error_msg .= '<p class="error">Database error Line 39</p>';
                $stmt->close();
    }


    if (empty($error_msg)) {


 
        // Delete the user
        if ($insert_stmt = $mysqli->prepare("DELETE FROM s_message WHERE title=?")) {
            $insert_stmt->bind_param('s', $title);
            // Execute the prepared query.
            if (! $insert_stmt->execute()) {
                header('Location: ../public/error.php?err=Registration failure: INSERT');
            }
        }
        
         header('Location: ../public/success.php?success=Du har tagit bort meddelandet &back=deleteServiceMessage.php '. $email); 
    }
    
}
