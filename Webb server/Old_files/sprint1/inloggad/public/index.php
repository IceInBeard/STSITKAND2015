<?php
include 'header.php';

if (login_check($mysqli) == false) {
    header("Location: login.php");
}

?>

<?php if (login_check($mysqli) == true) : ?>
		
		<table class="kommun-meny">
            <tr><td class="kommun-val-bild"><img class="menyBild" src="img/issuereporting1.jpg"></td><td class="kommun-val-bild"><img class="menyBild" src="img/socialmedia1.jpg"></td><td class="kommun-val-bild"><img class="menyBild" src="img/cykel1.jpg"></td></tr>
             <tr><td class="kommun-val-header" ><a href="http://stsitkand.student.it.uu.se/issuereporting/">Issue Reporting </a></td><td class="kommun-val-header">
                <a href="socialmedia.php">Social media</a></td><td class="kommun-val-header">
                <a href="http://stsitkand.student.it.uu.se/cykel/indexBicycle.php">Cykel</a></td></tr>
            <tr><td class="kommun-val">Här står det massa vettigt om issue reporting</td><td class="kommun-val">Social media</td><td class="kommun-val">Cykel</td></tr>
        </table>

<?php else : ?>
            <div>
                <span class="error">Du har inte rättigheter till denna sida.</span> Var god <a href="login.php">logga in</a>.
            </div>
<?php endif; ?>

    

<?php 
include "footer.php";
?>