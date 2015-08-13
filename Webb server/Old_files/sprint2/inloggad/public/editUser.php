<?php
include "../includes/editUser.inc.php";
include_once '../includes/db_connect.php';
include_once '../includes/psl-config.php';
include "header.php";

if (login_check($mysqli) == false) {
    header("Location: login.php");


}
	$id = filter_input(INPUT_GET, 'id', $filter = FILTER_SANITIZE_STRING);
	
 
if (! $id) {
    header("Location: searchUser.php");
}

  $result= getUser($mysqli,$id);

?>
<div id="container">
    <div id="content">


<div class="tillbaka_knapp" > <a href="listUsers.php"> Tillbaka</a></div>
<div class="loginContainer">
    <?php if (login_check($mysqli) == true) : ?>
        <?php if (admin_check($mysqli) == true) : ?>
    <div class="login-head">
        <h1>Redigera användare</h1>
         <div class="alert-close"> </div>           
    </div>


        <form   class="loginForm" action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>" 
                method="post" 
                name="edit_form">
                
                
                <p type="text" name="idtext" class="text" value= <?php echo $id ?> >Du redigerar användaren med ID nr: <?php  echo $id ?> </p>
                
            

             <li style="display:none;">
                <input style="color:#000;" type="text" name="id" class="text" value= <?php echo $id ?> >
            </li>
 
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
               
                <input type="submit" onclick="return regformhashEditUser(this.form,
                                   this.form.username,
                                   this.form.email,
                                   this.form.admin);"   value="Ändra användaren">
             
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