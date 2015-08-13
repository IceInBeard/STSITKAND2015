<?php
include "header.php";


if (login_check($mysqli) == false) {
    header("Location: login.php");
}
?>

<div class="tillbaka_knapp" > <a href="http://stsitkand.student.it.uu.se/sprint1/inloggad/public/admin.php"> Tillbaka</a></div>


<?php
listUsers();



include "footer.php";
?>


