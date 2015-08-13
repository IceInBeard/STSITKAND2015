<?php
include_once '../includes/db_connect.php';
include_once '../includes/functions.php';

if (login_check($mysqli) == false) {
    header("Location: login.php");
}

 
sec_session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Secure Login: Protected Page</title>
        <link rel="stylesheet" href="styles/main.css" />
    </head>
    <body>
        <?php if (login_check($mysqli) == true) : ?>
            <?php if (admin_check($mysqli) == true) : ?>
                <p>Welcome admin <?php echo htmlentities($_SESSION['username']); ?>!</p>
                <p>
                    This is the admin page.
                </p>
                <p>Return to <a href="index.php">login page</a></p>

            <?php else : ?>
                <p>
                    You are not an admin. Please log in to an admin account to view this page.
                </p>
                <p>Return to <a href="index.php">login page</a></p>
            <?php endif; ?>
        <?php else : ?>
            <p>
                    <span class="error">You are not authorized to access this page.</span> Please <a href="index.php">login</a>.
            </p>
        <?php endif; ?>
    </body>
</html>
