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



    echo "Hej hej sofia";

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
        /*

            $code=rand(100,999);
            $headers = 'From: webmaster@example.com' . "\r\n" .
            'Reply-To: webmaster@example.com' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();

            $message="You activation link is: Hej hej Sofia";
            mail($email, "New Pass", $message, $headers);
            echo "Email sent";
            echo $email;
            */

            $to= "Jakob.wahleman@gmail.com";
            $subject = "Mail från STSITKAND";
            $message = "Trudelutt detta kom visst fram!";
            $header = "From: stsitkand@it.uu.se ";
            $retval = mail($to, $subject, $message, $header);
            echo $to;
            echo $subject;
            echo $message;
            echo $header;
            if ($retval == true)
            {
                echo "message sent succesfully!";

            }
            else
            {
                echo "FAIL!";
            }





            
 
        
    }

   

}


?>