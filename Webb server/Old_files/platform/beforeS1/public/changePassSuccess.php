<?php
include 'header.php';

if (login_check($mysqli) == false) {
    header("Location: login.php");
}


?>

<div class="loginContainer">
    
    <div class="login-head">
        <h1> Du har nu bytt ditt lösenord!</h1>
    </div>
    <form   class="loginForm">

        <li class="regAdmin">Återgå till <a href="login.php">inloggning</a>,</li>

        <div class="alert-close"> </div>   
    </form>        
    
      

</div>


