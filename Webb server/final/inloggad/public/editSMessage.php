<!-- At this page a admin can change attributes on a servicemessage in the database -->

<?php
include "../includes/editSMessage.inc.php";
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
    header("Location: searchSMessage.php");
}

    //use the getMessage() function in ../includes/editSMessage.inc.php to get information about the user from the database
  $result= getMessage($mysqli,$id);

  $nu=date('Y-m-d\TH:i');
  $sen=date('Y-m-d\TH:i', strtotime('+1 hours'));

?>
<div id="container">
    <div id="content">



<div class="tillbaka_knapp" > <a href="searchSMessage.php"> Tillbaka</a></div>
<div class="loginContainer">
    <!-- Check if the viever is logged in and a admin, else hides the content of the page. Using the login_check and admin_check functions from ../includes/functions.php.  -->
    <?php if (login_check($mysqli) == true) : ?>
        <?php if (admin_check($mysqli) == true) : ?>
    <div class="login-head">
        <h1>Redigera servicemeddelande</h1>
         <div class="alert-close"> </div>           
    </div>

        <!-- Creates the form for editing servicemessages. When the submit button is pressed, it uses ../includes/editSMessage.inc.php to make
        the changes in the database -->
        <form   id="edit_service_form" class="loginForm" action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>" 
                method="post" 
                name="edit_form">
                
                
                <p type="text" name="idtext" class="text" value= "<?php echo $id; ?> ">Du redigerar servicemeddelandet med ID nr: <?php  echo $id ?> </p>
                
            
            <!-- create a hidden field in the form for the id of the message. It is hidden because the admin is not allowed to
            change the ID, but the field is needed in order to get the id variable to the ../includes/editSMessage.inc.php page -->
             <li style="display:none;">
                <input style="color:#000;" type="text" name="id" class="text" value= "<?php echo $id ?>" >
            </li>
            
            <!-- Here the admin can enter the new attributes of the s_message. When the page is loaded the old values 
            are entered in the box -->
            <li>
                <input style="color:#000;" type="text" name="title" class="text" value="<?php echo $result['title']; ?>" >
            </li>
                
            <li>
               <input style="color:#000;" name="message" type="text" value="<?php echo $result['message']; ?>"></input>
            </li>
            Starttid<li>
                <input type="datetime-local" name="starttime" min="<?php echo $nu; ?>" value="<?php echo $nu; ?>">
            </li>
            Stoptid
            <li>
                <input type="datetime-local" name="stoptime" min="<?php echo $nu; ?>" value="<?php echo $sen; ?>">
            </li>
                <div class="clear"> </div>
            

            <li class="regAdmin">
            Close page?
            <div class="radio">
                <input id="yes" type="radio" name="close" value="1" <?php if($result['close']=='1'){echo 'checked';} ?> >
                <label for="yes">Ja</label>
                <input id="no" type="radio" name="close" value="0" <?php if($result['close'] !='1'){echo 'checked';} ?>>
                <label for="no">Nej</label>
            </div>

    
            </li> 
            

            <div class="clear"> </div>
            <div class="submit">
               
               <!-- The submit button. When pressed, calls the function regformhashService in js/forms.js to check that 
            the fields are entered in a correct way. -->
                <input type="submit" onclick="return regformhashService(this.form,
                                   this.form.title,
                                   this.form.message,
                                   this.form.starttime,
                                   this.form.stoptime,
                                   this.form.close);"   value="Ändra">
             
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