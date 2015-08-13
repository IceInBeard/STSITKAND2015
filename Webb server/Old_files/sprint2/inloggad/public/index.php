<?php
include 'header.php';

if (login_check($mysqli) == false) {
    header("Location: login.php");
}

?>


<div id="container">
    <div id="content">
        
<?php if (login_check($mysqli) == true) : ?>
		<table class="kommun-meny">
            <tr><td class="kommun-val-bild"><img class="menyBild" src="img/issuereporting1.jpg"></td><td class="kommun-val-bild"><img class="menyBild" src="img/socialmedia1.jpg"></td><td class="kommun-val-bild"><img class="menyBild" src="img/cykel1.jpg"></td></tr>
             <tr><td class="kommun-val-header" ><a href="issuereporting.php">Issue Reporting </a></td><td class="kommun-val-header">
                <a href="../../index.php">Social media</a></td><td class="kommun-val-header">
                <a href="cykel.php">Cykel</a></td></tr>
            <tr><td class="kommun-val">Här står det massa vettigt om issue reporting</td><td class="kommun-val">Social media</td><td class="kommun-val">Cykel</td></tr>
        </table>

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