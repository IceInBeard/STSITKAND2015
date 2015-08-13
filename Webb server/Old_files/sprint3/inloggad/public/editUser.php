<!-- At this page a admin can change username, email and admin on a user in the database -->

<?php
include "../includes/editUser.inc.php";
include_once '../includes/db_connect.php';
include_once '../includes/psl-config.php';
include "header.php";

//check if the user is logged in, if not, redirect him to the login page. Using the login_check function from ../includes/functions.php. 
if (login_check($mysqli) == false) {
    header("Location: login.php");


}   
    //Get the ID of the user that the admin pressed that he wants to edit
	$id = filter_input(INPUT_GET, 'id', $filter = FILTER_SANITIZE_STRING);
	
//If something was wrong with the id, redirect the user back to the search page 
if (! $id) {
    header("Location: listUsers.php");
}

    //use the getUser() function in ../includes/editUser.inc.php to get information about the user from the database
  $result= getUser($mysqli,$id);

?>
<div id="container">
    <div id="content">


<div class="tillbaka_knapp" > <a href="listUsers.php"> Tillbaka</a></div>
<div class="loginContainer">
    <!-- Check if the viever is logged in and a admin, else hides the content of the page. Using the login_check and admin_check functions from ../includes/functions.php.  -->
    <?php if (login_check($mysqli) == true) : ?>
        <?php if (admin_check($mysqli) == true) : ?>
    <div class="login-head">
        <h1>Redigera användare</h1>
         <div class="alert-close"> </div>           
    </div>

        <!-- Creates the form for editing users. When the submit button is pressed, it uses ../includes/editUser.inc.php to make
        the changes in the database -->
        <form   class="loginForm" action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>" 
                method="post" 
                name="edit_form">
                
                
                <p type="text" name="idtext" class="text" value= <?php echo $id ?> >Du redigerar användaren med ID nr: <?php  echo $id ?> </p>
                
            
            <!-- create a hidden field in the form for the id of the user. It is hidden because the admin is not allowed to
            change the ID, but the field is needed in order to get the id variable to the ../includes/editUser.inc.php page -->
             <li style="display:none;">
                <input style="color:#000;" type="text" name="id" class="text" value= <?php echo $id ?> >
            </li>
            
            <!-- Here the admin can enter the new email, username or admin of users. When the page is loaded the old values 
            are entered in the box -->
            <li>
                <input style="color:#000;" type="text" name="username" class="text" value= <?php echo $result['username'] ?> >
            </li>

            <li>
                <input style="color:#000;" type="text" name="email" class="text" value=<?php echo $result['email'] ?> >
            </li>
                <div class="clear"> </div>
            

            <li class="regAdmin">
            Administratör?
            <div class="radio">
                <input id="yes" type="radio" name="admin" value="1" <?php if($result['admin']=='1'){echo 'checked';} ?> >
                <label for="yes">Ja</label>
                <input id="no" type="radio" name="admin" value="0" <?php if($result['admin'] !='1'){echo 'checked';} ?>>
                <label for="no">Nej</label>
            </div>

    
            </li> 
            

            <div class="clear"> </div>
            <div class="submit">
               
               <!-- The submit button. When pressed, calls the function regformhashEditUser in js/forms.js to check that 
            the fields are entered in a correct way. -->
                <input type="submit" onclick="return regformhashEditUser(this.form,
                                   this.form.username,
                                   this.form.email,
                                   this.form.admin);"   value="Ändra användaren">
             
                          <div class="clear">  </div>   
            </div>
                
        </form>


            <!-- The end of the if statements in the beginning that checked if the user was logged in as an admin -->
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