<?php

include "header.php";
include "../includes/forgotPass.inc.php";

?>


<div id="container">
    <div id="content">

<div class="tillbaka_knapp" > <a href="http://stsitkand.student.it.uu.se/platform/inloggad/public/login.php"> Tillbaka</a></div>

<div class="loginContainer">
    <div class="login-head">
        <h1>Glömt lösenord</h1>
         <div class="alert-close"> </div>           
    </div>
	<form   class="loginForm" action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>" 
			method="post" 
            name="registration_form">

             <?php
                if (!empty($error_msg)) {
                    echo $error_msg;
                }
            ?>

            <li>
                <input type="text" name="email" class="text" value="E-post adress" onfocus="if(this.value == 'E-post adress') { this.value = '';}" onblur="if (this.value == '') {this.value = 'E-post adress';}">
            </li>
                <div class="clear"> </div>
            
     
            <div class="submit">
                <input type="submit"  value="Skicka nytt lösenord">
                          <div class="clear">  </div>   
            </div>
                
        </form>
    </div>

  </div> <!-- content -->
</div> <!-- container -->

<?php

include "footer.php";

?>