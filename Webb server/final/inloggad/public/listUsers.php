<!-- This page allow the user to search at the name or email of a user/users and get a list of the id, username, E-mail and admin 
    for one, a few, or all users in the database -->

<?php
include "../includes/searchUsers.php";
include "header.php";


//Check if the user is logged in, else redirect her/him to the login.php page. 

if (login_check($mysqli) == false) {
    header("Location: login.php");
}
?>
<div id="container">
    <div id="content">

<div class="tillbaka_knapp" > <a href="admin.php"> Tillbaka</a></div>


<!-- Check if the user is logged in, and if the logged in user is a admin. If any of those are false the 
    content of the page remain hidden -->
 <?php if (login_check($mysqli) == true) : ?>
    <?php if (admin_check($mysqli) == true) : ?>

<div class="loginContainer">

    
    <div class="login-head">
        <h1>Sök användare</h1>
         <div class="alert-close"> </div>           
    </div>

        <!-- Create the form where the user can enter the whole, or part of, 
        the name or email of the users she/he wants to search for. 
        When the submit button is pressed, it uses the ../includes/searchUsers.php page to get the list -->
        <form   class="loginForm" action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>" 
                method="post" 
                name="registration_form">

   
            <li class="regAdmin">Sök användare på namn eller E-mail. </br></br> Om du inte skriver något i fältet listar du alla användare.</li>
            

            <!-- Check if there was any error when ../includes/searchUsers.php was running, if so, prints them here -->
            <?php
                if (!empty($error_msg)) {
                    echo $error_msg;
                }
            ?>

            <!-- Here the email or name is entered, if the bos is empty, it says "Namn eller E-mail", when pressed, it becomes empty -->
            <li>
                <input id="search" type="text" name="search" class="text" placeholder="Namn eller E-mail" autocomplete="off">
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

        /* Here the list of the users of the search is printed. The variable $text is created in ../includes/searchUsers.php
        and contains a string with html code that creates a table */
        echo $changePassForm;
        echo $editform;
        echo $text;

        ?>


<!-- The end of the statements in the beginning that hides the page if the viewer is not logged in or admin -->
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


