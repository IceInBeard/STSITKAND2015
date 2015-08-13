<?php
include 'header.php';

if (login_check($mysqli) == false) {
    header("Location: login.php");
}


?>
<div id="container">
    <div id="content">


    <?php if (login_check($mysqli) == true) : ?>
    <?php if (admin_check($mysqli) == true) : ?>


    <table class="kommun-meny">          
            <tr><td class="kommun-val-header" ><a href="registerAsAdmin.php">Lägg till användare </a></td><td class="kommun-val-header"><a href="deleteMeny.php">Ta bort användare</a></td><td class="kommun-val-header"><a href="listUsers.php">Sök och redigera användare</a></td></tr>
            <tr><td class="kommun-val">Här kan du lägga till nya användare.</td><td class="kommun-val">Här kan du ta bort en användare</td><td class="kommun-val">Lista och redigera användarna i databasen</td></tr>
    </table>

   
            <?php else : ?>
                <p>
                    Du är ingen admin. Var god och logga in på ett konto med användarrättigheter för att se denna sida. 
                </p>
                <p>Återgå till <a href="login.php">login sidan</a></p>
            <?php endif; ?>
        <?php else : ?>
            <div>
                <span class="error">Du har inte rättigheter till denna sida.</span> Var god <a href="login.php">logga in</a>.
            </div>
        <?php endif; ?>

    </div> <!-- content -->
</div> <!-- container -->
<?php 
include "footer.php";
?>