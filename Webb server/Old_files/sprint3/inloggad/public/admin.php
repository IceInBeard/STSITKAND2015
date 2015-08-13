<!-- This is the index page for the admin functions. It contains links to all the different admin functions on 
    the page -->

<?php
include 'header.php';

//If the viewer is not logged in, it redirects the user to the login page. Using the login_check function from ../includes/functions.php. 
if (login_check($mysqli) == false) {
    header("Location: login.php");
}


?>
<div id="container">
    <div id="content">

    <!-- Check if the viewer is logged in and a admin. If this is not true, the content of the page is hidden. Using the login_check and admin_check functions from ../includes/functions.php.  -->
    <?php if (login_check($mysqli) == true) : ?>
    <?php if (admin_check($mysqli) == true) : ?>

    <!-- Table with links to the different admin pages -->
    <table class="kommun-meny">    
            <tr><td class="kommun-val-bild"><a class="flaticon-add40" href="registerAsAdmin.php"> </a>  </td>
                <td class="kommun-val-bild"><a class="flaticon-user32" href="deleteMeny.php"> </a>  </td>
                <td class="kommun-val-bild"><a class="flaticon-searching31" href="listUsers.php"> </a>  </td></tr>      
            
            <tr><td class="kommun-val-header" ><a href="registerAsAdmin.php">Lägg till användare </a></td>
                <td class="kommun-val-header"><a href="deleteMeny.php">Ta bort användare</a></td>
                <td class="kommun-val-header"><a href="listUsers.php">Sök och redigera användare</a></td></tr>
            
            <tr><td class="kommun-val">Här kan du lägga till nya användare.</td>
                <td class="kommun-val">Här kan du ta bort en användare</td>
                <td class="kommun-val">Lista,ta bort och redigera användarna i databasen</td></tr>
            
            <tr><td class="kommun-val-bild"><a class="flaticon-speech-bubble15" href="createservicemessage.php"> </a>  </td>
                <td class="kommun-val-bild"><a class="flaticon-remove1" href="deleteServiceMessage.php"> </a></td>
                <td class="kommun-val-bild"><a class="flaticon-search100" href="searchSMessage.php"></a>  </td></tr>
            
            <tr><td class="kommun-val-header" ><a href="createservicemessage.php">Lägg till servicemeddelanden</a></td>
                <td class="kommun-val-header" ><a href="deleteServiceMessage.php">Ta bort servicemeddelanden</a></td>
                <td class="kommun-val-header"><a href="searchSMessage.php">Sök och redigera servicemeddelande</a></td></tr>
            
            <tr><td class="kommun-val">Skapa servicemeddelanden och stänga den publika sidan</td>
                <td class="kommun-val">Här kan du ta bort ett servicemeddelande</td>
                <td class="kommun-val">Lista, ta bort och redigera servicemeddelanden i databasen</td></tr>

        
    </table>

            <!-- The end to the if-statements in the beginning that checked if the user was logged in as admin or
            else hides the page -->
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