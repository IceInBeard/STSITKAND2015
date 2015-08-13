<?php

$error_msg = "";

if (isset($_POST['username'], $_POST['email'],  $_POST['admin'])) {
    // Sanitize and validate the data passed in
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $email = filter_var($email, FILTER_VALIDATE_EMAIL);
    $admin = (int) $_POST['admin'];

    echo "Hej Hej";


    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Not a valid email
        $error_msg .= '<p class="error">E-postadressen är inte gilig.</p>';
    }


    if ($insert_stmt = $mysqli->prepare("UPDATE members
        SET username= ?, email= ? , admin= ?     WHERE id= ?")) {
            $insert_stmt->bind_param('ssss', $username, $email, $admin, $user_id);

            // Execute the prepared query.
            if (! $insert_stmt->execute()) {
                header('Location: ../public/error.php?err=Update error: UPDATE');
            }
        }
        
         header('Location: ../public/success.php?success=Du du har uppdaterat användare '.$email);

        }


?>