<?php
include_once '../includes/register.inc.php';
include_once 'header.php';

if (login_check($mysqli) == false) {
    header("Location: login.php");
}

?>
<div id="container">
    <div id="content">


<div class="tillbaka_knapp" > <a href="admin.php"> Tillbaka</a></div>
<div class="loginContainer">
    <?php if (login_check($mysqli) == true) : ?>
        <?php if (admin_check($mysqli) == true) : ?>
    <div class="login-head">
        <h1>Registrera användare</h1>
         <div class="alert-close"> </div>           
    </div>
        <form   class="loginForm" action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>" 
                method="post" 
                name="registration_form">

                <?php echo $error_msg; ?> 

            <li>
                <input type="text" name="username" class="text" value="Användarnamn" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Namn';}">
            </li>

            <li>
                <input type="text" name="email" class="text" value="E-post adress" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'E-post adress';}">
            </li>
                <div class="clear"> </div>
            <li>
                <input type="password" name="password" value="password" id="password" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'password';}"> 
            </li>

            <li>
                <input type="password" name="confirmpwd" value="password" id="confirmpwd" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'password';}"> 
            </li>

            <li class="regAdmin">
            Administratör?
            <div class="radio">
                <input id="yes" type="radio" name="admin" value="1">
                <label for="yes">Ja</label>
                <input id="no" type="radio" name="admin" value="0">
                <label for="no">Nej</label>
            </div>

    
            </li> 
            

            <div class="clear"> </div>
            <div class="submit">
               
                <input type="submit" onclick="return regformhash(this.form,
                                   this.form.username,
                                   this.form.email,
                                   this.form.password,
                                   this.form.confirmpwd,
                                   this.form.admin);"   value="Registrera">
             
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
