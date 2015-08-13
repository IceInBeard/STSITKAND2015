<?php
include "header.php";
include "../includes/listUsers.inc.php";
if (login_check($mysqli) == false) {
    header("Location: login.php");
}

listUsers();

?>

