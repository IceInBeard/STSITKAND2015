<?php
include 'header.php';

if (login_check($mysqli) == false) {
    header("Location: login.php");
}


?>

<div id="container">
    <div id="content">

<div class="loginContainer">
    <?php if (login_check($mysqli) == true) : ?>
    <div class="login-head">
        <h1> Du har nu bytt ditt lösenord!</h1>
    </div>
    <form   class="loginForm">

        <li class="regAdmin">Återgå till <a href="login.php">inloggning</a>,</li>

        <div class="alert-close"> </div>   
    </form>     
    <?php else : ?>
            <div>
                <span class="error">Du har inte rättigheter till denna sida.</span> Var god <a href="login.php">logga in</a>.
            </div>
    <?php endif; ?>     
    
      

</div>


    </div> <!-- content -->
</div> <!-- container -->

   
<?php
include "footer.php";
?>

