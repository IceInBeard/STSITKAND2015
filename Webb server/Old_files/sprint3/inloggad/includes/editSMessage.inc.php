<!-- The include page used by ../public/editSMessage.php to edit a servicemessage in the database -->

<?php
include_once 'db_connect.php';
include_once 'psl-config.php';


$error_msg = "";
 

//Get the variables entered in the form at ../public/editSMessage..php 
if (isset($_POST['id'], $_POST['title'], $_POST['message'], $_POST['starttime'], $_POST['stoptime'], $_POST['close'])) {
    // Sanitize and validate the data passed in 
  
    $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
    $message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);



    $starttime = date('Y-m-d H:i:s', strtotime($_POST['starttime']));
    $stoptime = date('Y-m-d H:i:s', strtotime($_POST['stoptime']));

    
    $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);
    $close = (int) $_POST['close'];







    //Changes the values to those entered in the form on the servicemessage with the id that the user choose to edit
    if ($insert_stmt = $mysqli->prepare("UPDATE s_message

        SET title= ?, message= ? , start_time= ? , stop_time= ?, close= ?    WHERE id= ?")) {
            $insert_stmt->bind_param('ssssss', $title, $message, $starttime, $stoptime, $close, $id);
            
            // Execute the prepared query.
            if (! $insert_stmt->execute()) {
                header('Location: ../public/error.php?err=Update error: UPDATE');
            }

        }
        
    header('Location: ../public/success.php?success=Du du har uppdaterat meddelandet '.$title.'&back=searchSMessage.php');


    }
    




// This function is used by ../public/editSMessage.php to get the different values on the servicemessage the admin wants to edit
function getMessage($mysqli, $id){


	$prep_stmt = "SELECT title, message, start_time, stop_time, close FROM s_message WHERE id = ? LIMIT 1";
	
    $stmt = $mysqli->stmt_init();
    $stmt = $mysqli->prepare($prep_stmt);

    
   
    if ($stmt) {
        $stmt->bind_param('s', $id);
        $stmt->execute();
    

        $result = $stmt->get_result();

        
        $stmt->close();

    } else {
        $error_msg .= '<p class="error">Database error Line 39</p>';
                $stmt->close();
    }

    return $result->fetch_assoc();
}



?>