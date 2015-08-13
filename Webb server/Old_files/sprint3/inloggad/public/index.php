<!-- This is the first page you get the after logging in. It contains links to the other parts of the logged in pages -->

<?php
include 'header.php';


//Check if the viewer is logged in, else redirect her/him the the login page. Using the login_check  function from ../includes/functions.php. 
if (login_check($mysqli) == false) {
    header("Location: login.php");
}

?>


<div id="container">
    <div id="content">

<!-- Check if the viewer is logged in, else hides the content. Using the login_check and admin_check functions from ../includes/functions.php. -->        
<?php if (login_check($mysqli) == true) : ?>

        <!-- Create a table with links to other parts of the website -->
		<table class="kommun-meny">
            <tr><td class="kommun-val-bild"><a href="../../index.php"><img class="menyBild" src="img/uppsalakarta.jpg"></a></td>
	<td class="kommun-val-bild"><a href="issuereporting.php" ><img class="menyBild" src="img/issuereporting1.jpg"></a></td>
<td class="kommun-val-bild"><a href="cykel.php"><img class="menyBild" src="img/cykel1.jpg"></a></td></tr>
             
		<tr><td class="kommun-val-header" ><a href="../../index.php">Karta</a></td>
                <td class="kommun-val-header" ><a href="issuereporting.php" >Felrapportering </a></td>
                <td class="kommun-val-header"><a href="cykel.php">Cykel</a></td></tr>
            <tr><td class="kommun-val">Tweets, felrapporteringar och cykelinformation</td><td class="kommun-val">Felrapporterings backoffice</td><td class="kommun-val">Cykelfunktionernas backoffice</td></tr>
        </table>

<!-- The end of the if statment that hides the page if the user is nog logged in -->
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
