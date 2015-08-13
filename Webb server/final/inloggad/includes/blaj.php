<!-- This is the file used by ../public/changePass.php to connect to the database and change the password of the user -->

<?php
include_once 'db_connect.php';
include_once 'psl-config.php';
include_once 'functions.php';
 
//sec_session start() is a function in functions.php used to get information about the user currently logged in
sec_session_start();

$error_msg = "";

print_r($_POST);

//Get the new and old password entered by the user at ../public/changePass.php
if (isset($_POST['p'], $_POST['id'])) {

    $user_id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);

 
    $password = filter_input(INPUT_POST, 'p', FILTER_SANITIZE_STRING);
    if (strlen($password) != 128) {
        // The hashed pwd should be 128 characters long.
        // If it's not, something really odd has happened
        $error_msg .= '<p class="error">Ogiltig form på lösenordet.</p>';
    }

    
    if (empty($error_msg)) {

        // Create a random salt
        //$random_salt = hash('sha512', uniqid(openssl_random_pseudo_bytes(16), TRUE)); // Did not work
        $random_salt = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));
 
        // Create salted password 
        $password = hash('sha512', $password . $random_salt);
        
        // Update the password and salt to the new one
        if ($insert_stmt = $mysqli->prepare("UPDATE members
        SET password= ?, salt= ?

        WHERE id= ?")) {
            $insert_stmt->bind_param('sss', $password, $random_salt, $user_id);

            // Execute the prepared query.
            if (! $insert_stmt->execute()) {
                header('Location: ../public/error.php?err=Registration failure: INSERT');
            }
        }
        
         header('Location: ../public/success.php?success=Du har ändrat lösen på '.$user_id);
    }
}

?>