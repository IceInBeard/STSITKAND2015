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
        <?php if (admin_check($mysqli) == true) : ?>
    <div class="login-head">
        <h1>Registreringen är nu genomförd!</h1>
    </div>
    <form   class="loginForm">

        <li class="regAdmin">Återgå till <a href="admin.php">administratörsida</a>,</li>
        <li class="regAdmin">eller <a href="registerAsAdmin.php">registrera ytterligare användare </a></li>
        <div class="alert-close"> </div>   
    </form> 
        <?php else : ?>
            <p>
                Du är ingen admin. Var god och logga in på ett konto med användarrättigheter för att se denna sida. 
            </p>
            <p>Return to <a href="login.php">login page</a></p>
        <?php endif; ?>
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
