<?php
include_once '../includes/deleteRow.php';
include 'header.php';

if (login_check($mysqli) == false) {
    header("Location: login.php");
}

?>
<div class="loginContainer">

    <?php if (login_check($mysqli) == true) : ?>
        <?php if (admin_check($mysqli) == true) : ?>
    <div class="login-head">
        <h1>Radera användare</h1>
         <div class="alert-close"> </div>           
    </div>
        <form   class="loginForm" action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>" 
                method="post" 
                name="registration_form">

   
            <li class="regAdmin">Skriv in E-post adress för den användare du vill radera</li>
            
            <?php
                if (!empty($error_msg)) {
                    echo $error_msg;
                }
            ?>
            <li>
                <input id="email" type="text" name="email" class="text" value="E-post adress" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'E-post adress';}">
            </li>
                <div class="clear"> </div>
            

            

            <div class="clear"> </div>
            <div class="submit">
                <input type="submit"  value="Radera användare">
             
                          <div class="clear">  </div>   
            </div>
            


                
        </form>

       
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

</div>
<div class="listView">
    <br><br><br>

            <?php 
            listUsers(); ?>

            

</div>
        <!-- Registration form to be output if the POST variables are not
        set or if the registration script caused an error. -->

        
        
        <!-- Creates the form where we enter the E-mail -->

        
        <!--<p>Return to the <a href="admin.php">admin page</a>.</p>-->
    </body>
</html>
