<?php
include 'header.php';

if (login_check($mysqli) == false) {
    header("Location: login.php");
}

?>
		
		<table class="kommun-meny">
            <tr><td class="kommun-val-bild"><img class="menyBild" src="img/issuereporting.jpg"></td><td class="kommun-val-bild"><img class="menyBild" src="img/socialmedia2.jpg"></td><td class="kommun-val-bild"><img class="menyBild" src="img/cykel1.jpg"></td></tr>
             <tr><td class="kommun-val-header" ><a href="#">Issue Reporting </a></td><td class="kommun-val-header" href="#"><a href="#">Social media</a></td><td class="kommun-val-header" href="#"><a href="#">Cykel</a></td></tr>
            <tr><td class="kommun-val">Här står det massa vettigt om issue reporting</td><td class="kommun-val">Social media</td><td class="kommun-val">Cykel</td></tr>
        </table>


    

<?php 
include "footer.php";
?>