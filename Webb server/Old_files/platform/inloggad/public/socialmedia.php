<?php
include 'header.php';

if (login_check($mysqli) == false) {
    header("Location: login.php");
}

?>
<div id="container-wide">
    <div id="content">
    	Supersocial media!!! :D Hej hej! 

    </div> <!-- content -->
</div> <!-- container -->


<?php
include "footer.php";
?>
