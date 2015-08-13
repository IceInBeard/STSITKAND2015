<?php
include_once '../includes/db_connect.php';
include_once '../includes/functions.php';
 
sec_session_start();
 
if (login_check($mysqli) == true) {
    $logged = 'inloggad';
} else {
    $logged = 'utloggad';
}
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Secure Login: Log In</title>
        <link rel="stylesheet" href="styles/main.css" />
        <script type="text/JavaScript" src="js/sha512.js"></script> 
        <script type="text/JavaScript" src="js/forms.js"></script> 
    </head>
    <body>
        <?php
        if (isset($_GET['error'])) {
            echo '<p class="error">Fel: Vid inloggning!</p>';
        }
        ?> 
        <form action="../includes/process_login.php" method="post" name="login_form">                      
            Email: <input type="text" name="email" />
            Password: <input type="password" 
                             name="password" 
                             id="password"/>
            <input type="button" 
                   value="Logga in" 
                   onclick="formhash(this.form, this.form.password);" /> 
        </form>
 
<?php
        if (login_check($mysqli) == true) {
                        echo '<p>Du är ' . $logged . ' som ' . htmlentities($_SESSION['username']) . '.</p>';
 
            echo '<p>Vill du växla användare? <a href="../includes/logout.php">Logga ut</a>.</p>';
        } else {
                        echo '<p>Du är ' . $logged . '.</p>';
                        echo "<p>Om du inte har en loggin. Prata med ansvarig administratör.</p>";
                }
?>      
    </body>
</html>
