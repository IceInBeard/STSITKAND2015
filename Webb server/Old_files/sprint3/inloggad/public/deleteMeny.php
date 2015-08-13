<!-- At this page a admin can delete a user from the database by entering that users E-mail. -->

<?php
include_once '../includes/deleteRow.php';
include 'header.php';

//Check if the viewer is logged in, else redirect her/him to the login page. Using the login_check function from ../includes/functions.php. 
if (login_check($mysqli) == false) {
    header("Location: login.php");
}

?>

<div id="container">
    <div id="content">

<!-- Check if the user is logged in and if the logged in user is a admin. Else hides the content of the page. Using the login_check and admin_check functions from ../includes/functions.php.  -->
<?php if (login_check($mysqli) == true) : ?>
        <?php if (admin_check($mysqli) == true) : ?>

        <div class="tillbaka_knapp" ><a href="admin.php"> Tillbaka</a></div>
<div class="loginContainer">

    
    <div class="login-head">
        <h1>Radera användare</h1>
         <div class="alert-close"> </div>           
    </div>

        <!-- Create the form where the email is entered.
        When the submit button is pressed, it uses the page ../includes/deleteRow.php to call the database and
        remove the user. -->
        <form   class="loginForm" action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>" 
                method="post" 
                name="registration_form">

   
            <li class="regAdmin">Skriv in E-post adress för den användare du vill radera</li>
            
            <!-- If there was any errors when the ..includes/deleteRow.php was used, they are printed here -->
            <?php
                if (!empty($error_msg)) {
                    echo $error_msg;
                }
            ?>
            <li>
                <input id="email" type="text" name="email" class="text" placeholder="E-post adress">
            </li>
                <div class="clear"> </div>
            

            

            <div class="clear"> </div>
            <div class="submit">
                <input type="submit"  value="Radera användare">
             
                          <div class="clear">  </div>   
            </div>
            


                
        </form>

       
        

</div>

        <!-- The end to the if statements in the beginning that hide the content if not logged in as a admin -->

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
        

     </div> <!-- content -->
</div> <!-- container -->

<?php
include "footer.php";
?>
