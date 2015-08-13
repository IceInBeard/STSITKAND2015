<?php
include 'header.php';

if (login_check($mysqli) == true) {
    header("Location: index.php");
}
?>


<div id="container">


    <div id="content">

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
