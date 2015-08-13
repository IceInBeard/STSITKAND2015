<!-- Page where you, as a admin, can enter the information about another user. This information is then sent to 
    the page register.inc.php where the new user get registred in the database. -->

<?php
include_once '../includes/register.inc.php';
include_once 'header.php';

// Checking if the viewer is logged in, if not, send them to the log in page. Using the login_check function from ../includes/functions.php
if (login_check($mysqli) == false) {
    header("Location: login.php");
}

?>
<div id="container">
    <div id="content">


<div class="tillbaka_knapp" > <a href="admin.php"> Tillbaka</a></div>
<div class="loginContainer">

    <!-- Check if the user is logged in, and then checks if the user is a admin. Using the login_check and admin_check functions from ../includes/functions.php. 
    If one of those conditions is false, it hides the content of the page -->
    <?php if (login_check($mysqli) == true) : ?>
        <?php if (admin_check($mysqli) == true) : ?>


    <div class="login-head">
        <h1>Registrera användare</h1>
         <div class="alert-close"> </div>                   
    </div>

        <!-- Create the form where the admin can enter the information about the new user. If the submit bottom is
        pressed, calls for the page register.inc.php -->
        <form   class="loginForm" action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>" 
                method="post" 
                name="registration_form">


                <!-- If a error message is created in register.inc.php, it is printed here -->
                <?php echo $error_msg; ?> 


            <!-- Create the fields where the information is entered, 
            entering the name of the field in the box until it is targeted, then makes it empty. -->
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

            <!-- Create radiobuttons where the user enters if the new user is admin or not. -->
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
            
            <!-- Create the submit button, when pressed, calls the regformhash function in js/forms.js that controlls that
            all the fields in the form is entered, and that the password are of the right length and form, then calls the 
            ../includes/register.inc.php file where the user is added to the database.  -->         
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
            <!-- the end to the if-statements in the start checking if the user is logged in and admin -->
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
