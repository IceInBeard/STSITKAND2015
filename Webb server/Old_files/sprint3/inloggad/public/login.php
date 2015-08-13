<!-- At this page the user can login to the backend pages. After entering a username and password it uses the page
    ../includes/process_login.php to check the database and, if entered correct, allows the user into the backend pages. -->
    

<?php
include 'header.php';

// Checks if the user is already logged in. If that is the case, sends the user to the index.php page
if (login_check($mysqli) == true) {
    header("Location: index.php");
}
?>


<div id="container">


    <div id="content">
            <!-- Check if there was an error when login in at the login function in ../includes/functions.php, 
            if so, prints a error message -->
            <?php
            if (isset($_GET['error'])) {
                echo '<p class="error">Error Logging In!</p>';
            }
            ?>

<div class="loginContainer">
    <div class="login-head">
        <h1>Logga in</h1>
         <div class="alert-close"> </div>           
    </div>
        <!-- Create the form where the user can enter the login information. 
        If the field is empty, prints what should be entered in it, when the field is targeted, makes it empty.
        When the submit button is pressed, goes to ../includes/process_login.php -->
        <form class="loginForm" action="../includes/process_login.php" method="post" name="login_form">
            <li>
                <input type="text" name="email" class="text" value="E-post adress" onfocus="if(this.value == 'E-post adress') { this.value = '';}" onblur="if (this.value == '') {this.value = 'E-post adress';}">
            </li>
                <div class="clear"> </div>
            <li>
                <input type="password" value="password" id="password" onfocus="if(this.value == 'password') { this.value = '';}" onblur="if (this.value == '') {this.value = 'password';}"> 
            </li>
            <div class="clear"> </div>
            <div class="submit">
                <!-- When the submit button is pressed, calls the formhash function in js/forms.js where it checks that
                the fields was entered in a correct way. -->
                <input type="submit" onclick="formhash(this.form, this.form.password);" value="Logga in">
                <h4><a href="#">Glömt ditt lösenord?</a></h4>
                          <div class="clear">  </div>   
            </div>
                
        </form>

</div>




    </div>
</div>   
<?php
include "footer.php";
?>
