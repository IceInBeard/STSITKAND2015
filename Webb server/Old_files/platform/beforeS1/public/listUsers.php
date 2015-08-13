<?php
include "header.php";

if (login_check($mysqli) == false) {
    header("Location: login.php");
}


listUsers();

?>
