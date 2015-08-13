<?php
include "../includes/searchUsersTest.php";
include "header.php";




if (login_check($mysqli) == false) {
    header("Location: login.php");
}
?>
<div id="container">
    <div id="content">

<div class="tillbaka_knapp" > <a href="http://stsitkand.student.it.uu.se/sprint1/inloggad/public/admin.php"> Tillbaka</a></div>

 <?php if (login_check($mysqli) == true) : ?>
    <?php if (admin_check($mysqli) == true) : ?>

<div class="loginContainer">

    
    <div class="login-head">
        <h1>Sök användare</h1>
         <div class="alert-close"> </div>           
    </div>
        <form   class="loginForm" action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>" 
                method="post" 
                name="registration_form">

   
            <li class="regAdmin">Sök användare på namn eller E-mail. </br></br> Om du inte skriver något i fältet listar du alla användare.</li>
            
            <?php
                if (!empty($error_msg)) {
                    echo $error_msg;
                }
            ?>
            <li>
                <input id="email" type="text" name="email" class="text" value="Namn eller E-mail" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Namn eller E-mail';}">
            </li>
                <div class="clear"> </div>
            

            

            <div class="clear"> </div>
            <div class="submit">
                <input type="submit"  value="Sök">
             
                          <div class="clear">  </div>   
            </div>

            


                
        </form>


       
        

</div>

		<?php

        echo $text;

        ?>

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


