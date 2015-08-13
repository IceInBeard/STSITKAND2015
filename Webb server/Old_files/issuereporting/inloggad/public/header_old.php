<?php
include_once '../includes/db_connect.php';
include_once '../includes/functions.php';

 
sec_session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Smarta uppsala</title>
    <script type="text/JavaScript" src="js/sha512.js"></script> 
    <script type="text/JavaScript" src="js/forms.js"></script>

    <link type="text/css" rel="stylesheet" href="../../css/struktur.css">
    <link type="text/css" rel="stylesheet" href="css/form.css">
    <!-- <link type="text/css" rel="stylesheet" href="css/kommunvyNyHeader.css"> -->
    <link type="text/css" rel="stylesheet" href="css/headerStyle.css">
    

</head>

<body>

<div id="header-container">
        <header id="top" class="clearfix" role="banner">
    <a href="/">
        <img src="img/UppsalaKommunLogoNeg.png" alt="Uppsala kommuns logotyp">
    </a>
       

        <?php 

            if (login_check($mysqli) == true) {
                echo '<div id="usernamediv">';
                echo 'Inloggad som ' . htmlentities($_SESSION['username']) . '. <a href="../includes/logout.php">Logga ut</a>.';
                echo '</div>';

            }
        ?>

        <div id="topMenu" role="navigation">
            <ul class="clearfix">
                    <?php if (login_check($mysqli) == true) : ?> 
                    <li><a href="index.php">Start</a></li>
                    <li><a href="#">Karta</a></li>
                    <li><a href="#">Issue Reporting</a></li>
                    <li><a href="#">Social Media</a></li>
                    <li><a href="#">Cykel</a></li>
                    <?php if (admin_check($mysqli) == true) : ?> <li><a href="admin.php">Admin</a></li> <?php endif; ?>
                    <li><a href="changePass.php">Min profil</a></li>
                    <?php endif; ?>
                    
            </ul>
        </div>

        
</div>





</header>

</div>
<div id="border-container">
    <div id="border"></div>
</div>

<div id="container">
    <div id="content">

