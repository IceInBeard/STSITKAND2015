<?php
include_once '../includes/createservicemessage.inc.php';
include_once 'header.php';

if (login_check($mysqli) == false) {
    header("Location: login.php");
}

$nu=date('Y-m-d\TH:i');
$sen=date('Y-m-d\TH:i', strtotime('+1 hours'));



?>



<div id="container">
    <div id="content">


<div class="tillbaka_knapp" > <a href="http://stsitkand.student.it.uu.se/sprint1/inloggad/public/admin.php"> Tillbaka</a></div>
<div class="loginContainer">
    <?php if (login_check($mysqli) == true) : ?>
        <?php if (admin_check($mysqli) == true) : ?>
    <div class="login-head">
        <h1>Lägg till servicemeddelande </h1>
         <div class="alert-close"> </div>           
    </div>
        <form id="service_form"  class="loginForm" action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>" 
                method="post" 
                name="service_form">

                <?php echo $error_msg; ?>

            <li>
                <input type="text" name="title" class="text" placeholder="Titel">
            </li>

            <li>
                <textarea name="message" form="service_form" placeholder="Servicemeddelandet..."></textarea>
            </li>
                <div class="clear"> </div>
            <li>Starttid
                <input type="datetime-local" name="starttime" min="<?php echo $nu; ?>" value="<?php echo $nu; ?>">
            </li>

            <li>Stoptid
                <input type="datetime-local" name="stoptime" min="<?php echo $nu; ?>" value="<?php echo $sen; ?>">
            </li>

            <li class="regAdmin">
            Stäng sidan?
            <div class="radio">
                <input id="yes" type="radio" name="close" value="1">
                <label for="yes">Ja</label>
                <input id="no" type="radio" name="close" value="0">
                <label for="no">Nej</label>
            </div>

    
            </li> 
            

            <div class="clear"> </div>
            <div class="submit">
               
                <input type="submit" onclick="return regformhashService(this.form,
                                   this.form.title,
                                   this.form.message,
                                   this.form.starttime,
                                   this.form.stoptime,
                                   this.form.close);"   value="Spara meddelande">
             
                          <div class="clear">  </div>   
            </div>
                
        </form>

            <?php else : ?>
                    <p>
                        Du är ingen admin. Var god och logga in på ett konto med användarrättigheter för att se denna sida. 
                    </p>
                    <p>Återgå till <a href="login.php">login sidan</a></p>
            <?php endif; ?>
        <?php else : ?>
            <div>
                 <span class="error">Du har inte rättigheter till denna sida.</span> Var god <a href="login.php">logga in</a>.
        <?php endif; ?>

</div>
    </div> <!-- content -->
</div> <!-- container -->


<?php 
include "footer.php";
?>
