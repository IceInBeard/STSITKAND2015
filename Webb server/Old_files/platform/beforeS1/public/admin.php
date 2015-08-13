<?php
include 'header.php';

if (login_check($mysqli) == false) {
    header("Location: login.php");
}


?>
<div class="container">


<div class="content">

    <?php if (login_check($mysqli) == true) : ?>
    <?php if (admin_check($mysqli) == true) : ?>

    <div class="btn">
        <a href="registerAsAdmin.php">
            <button class="knappar" id="hej2">
                <p class="knappText">Lägg till ny användare</button>
        </a>
    </div>

    <div class="btn">
        <button class="knappar" id="hej2">
            <p class="knappText">Supersak 1</p></button>
    </div>

    <div class="btn">
        <a href="listUsers.php">
            <button class="knappar" id="hej3">
                <p class="knappText">Lista användare</p></button>
        </a>
    </div>

    <div class="btn">
        <a href="changePass.php">
            <button class="knappar" id="hej4">
                <p class="knappText" >Byt lösenord</p></button>
        </a>
    </div>  

    <div class="btn">
        <a href="deleteMeny.php">
            <button class="knappar" id="hej5">
                <p class="knappText">Ta bort användare</p></button>
        </a>
    </div>
<div class="btn">
        <a href="index.php">
        <button class="knappar" id="hej6">
            <p class="knappText">Gå tilbaka</p></button>
        </a>
    </div>
    <p>Return to <a href="index.php">kommun page</a></p>
    <p>Return to <a href="login.php">login page</a></p>
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

</div>
</div>
</body>


</html>