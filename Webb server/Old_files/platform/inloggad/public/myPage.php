if (login_check($mysqli) == false) {
    header("Location: login.php");
}

?>


<div class="myPageContainer">

    <?php if (login_check($mysqli) == true) : ?>
    <div class="myPage-head">
        <h1>Min sida</h1>
         <div class="alert-close"> </div>           
    </div>
        
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
                <input type="submit"  value="Byt lösenord"
                onclick="return regformhashChangePass(this.form,
                                    this.form.currentPass,
                                    this.form.newPass,
                                    this.form.confirmpwd);" > 
             
                          <div class="clear">  </div>   
            </div>
            <br>
            <p class=regAdmin>Återgå till <a href="admin.php">Adminsidan</a>.</p>
                
        </form>
    <?php else : ?>
        <div>
            <span class="error">Du har inte rättigheter till denna sida.</span> Var god <a href="login.php">logga in</a>.
        </div>
    <?php endif; ?>


</div>

<?php include 'footer.php'; ?>