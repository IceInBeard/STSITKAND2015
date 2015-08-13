<?php
include 'header.php';

if (login_check($mysqli) == false) {
    header("Location: login.php");
}

?>
<div class="container">


<div class="content">


    <?php if (login_check($mysqli) == true) : ?>



    <div class="btn">
        <button class="knappar" id="hej2">
            <p class="knappText">Vag</button>
    </div>

    <div class="btn">
        <button class="knappar" id="hej2">
            <p class="knappText">Cykel</p></button>
    </div>

    <div class="btn">

        <button class="knappar" id="hej3">
            <p class="knappText">Social Media</p></button>
    </div>

    <div class="btn">
        <button class="knappar" id="hej4">
            <p class="knappText" >Uppsalanytt</p></button>
    </div>  

    <div class="btn">
        <button class="knappar" id="hej5">
            <p class="knappText">Park</p></button>
    </div>
<div class="btn">
        <a href="admin.php">
        <button class="knappar" id="hej6">
            <p class="knappText">Admin</p></button>
        </a>
    </div>


        <?php else : ?>
            <div>
                <span class="error">Du har inte rättigheter till denna sida.</span> Var god <a href="login.php">logga in</a>.
            </div>
        <?php endif; ?>

</div>
</div>
</body>


</html>