<?php
include_once 'db_connect.php';
include_once 'psl-config.php';
 
$error_msg = "";
    
if (isset($_POST['title'], $_POST['message'], $_POST['starttime'], $_POST['stoptime'],$_POST['close'])) {
    // Sanitize and validate the data passed in
    $title = filter_input(INPUT_POST, 'title', FILTER_SANITIZE_STRING);
    $message = filter_input(INPUT_POST, 'message', FILTER_SANITIZE_STRING);



    $starttime = date('Y-m-d H:i:s', strtotime($_POST['starttime']));
    $stoptime = date('Y-m-d H:i:s', strtotime($_POST['stoptime']));

    

    $close = (int) $_POST['close'];

    
 

    if (empty($error_msg)) {
 
        // Insert the new user into the database 
        if ($insert_stmt = $mysqli->prepare("INSERT INTO s_message (title, message, start_time, stop_time, close) VALUES (?, ?, ?, ?, ?)")) {
            $insert_stmt->bind_param('sssss', $title, $message, $starttime, $stoptime, $close);
            // Execute the prepared query.
            if (! $insert_stmt->execute()) {
                header('Location: ../public/error.php?err=Registration failure: INSERT');
            }
        }
        
         header('Location: ../public/success.php?success=Du har lagt till meddelandet '. $title);
    }
}
