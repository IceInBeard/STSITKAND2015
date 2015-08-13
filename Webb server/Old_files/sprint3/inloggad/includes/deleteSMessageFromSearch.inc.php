<!-- This is the include file used by ../public/deleteMeny.php to connect to the database and delete a user -->

<?php
include_once 'db_connect.php';
include_once 'psl-config.php';
 
$error_msg = "";

    //Get the variable entered in the form at ../public/deleteMeny.php
    //Get the ID of the user that the admin pressed that he wants to edit
    $id = filter_input(INPUT_GET, 'id', $filter = FILTER_SANITIZE_STRING);

    //If something was wrong with the id, redirect the user back to the search page 
    if (! $id) {
        header("Location: searchSMessage.php");
    }




    if (empty($error_msg)) {


 
        // Delete the user
        if ($insert_stmt = $mysqli->prepare("DELETE FROM s_message WHERE id=?")) {
            $insert_stmt->bind_param('s', $id);
            // Execute the prepared query.
            if (! $insert_stmt->execute()) {
                header('Location: ../public/error.php?err=Registration failure: INSERT');
            }
        }
        
         header('Location: ../public/success.php?success=Du har tagit bort meddelandet med ID: &back=searchSMessage.php '. $id); 
    }
?>