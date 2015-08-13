<!-- This is the page where a logged in user can change his/her password. -->

<?php
include '../includes/changePass.inc.php';
include 'header.php';

//Check if the viewer is logged in, else redirects to the login page. Using the login_check function from ../includes/functions.php. 
if (login_check($mysqli) == false) {
    header("Location: login.php");
}

?>
<div id="container">
    <div id="content">

<div class="loginContainer">
    <!-- Check if the user is logged in, else hide the content of the page. Using the login_check function from ../includes/functions.php. -->
    <?php if (login_check($mysqli) == true) : ?>
    <div class="login-head">
        <h1>Ändra ditt lösenord</h1>
         <div class="alert-close"> </div>           
    </div>
        <!-- Create the form where the user enters the old and new password.
        When the submit button is pressed, the page uses the page ../includes/changePass.inc.php to change 
        the password in the database. -->
        <form   class="loginForm" action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>" 
                method="post" 
                name="registration_form">

   
             <label for="password" class="regAdmin"> Skriv in ditt gamla lösenord </label>
             <li>
                <input id="password" type="password" name="currentPass"  class="text" value="Nytt lösenord" onfocus="if(this.value == 'Nytt lösenord') { this.value = '';}" onblur="if (this.value == '') {this.value = 'Nytt lösenord';}">
            </li>
            <label for="newPass" class="regAdmin"> Skriv in ditt nya lösenord </label>
            <li>
                <input id="newPass" type="password" name="newPass" class="text" value="Nytt lösenord" onfocus="if(this.value == 'Nytt lösenord') { this.value = '';}" onblur="if (this.value == '') {this.value = 'Nytt lösenord';}">
            </li>
            <label for="confirmpwd" class="regAdmin"> Upprepa ditt nya lösenord </label>
            <li>
                <input id="confirmpwd" type="password" name="confirmpwd" class="text" value="Nyt1 lösenord" onfocus="if(this.value == 'Nyt1 lösenord') { this.value = '';}" onblur="if (this.value == '') {this.value = 'Nyt1 lösenord';}">
            </li>

                <div class="clear"> </div>
            



            <div class="clear"> </div>
            <div class="submit">
                <!-- The submit button. When the button is pressed in calls the function regformhashChangePass() in js/forms.js 
                to check that all the fields is entered in a correct way -->
                <input type="submit"  value="Byt lösenord"
                onclick="return regformhashChangePass(this.form,
                                    this.form.currentPass,
                                    this.form.newPass,
                                    this.form.confirmpwd);" > 
             
                          <div class="clear">  </div>   
            </div>
            
                
        </form>

    <!-- The end of the if statment in the beginning that hides the page if the viewer is not logged in. -->
    <?php else : ?>
        <div>
            <span class="error">Du har inte rättigheter till denna sida.</span> Var god <a href="login.php">logga in</a>.
        </div>
    <?php endif; ?>


</div>

    </div> <!-- content -->
</div> <!-- container -->

<?php include 'footer.php'; ?>