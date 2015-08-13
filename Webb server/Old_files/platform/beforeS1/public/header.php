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
                
                    <li><a href="index.php">Start</a></li>
                    <li><a href="map.php">Karta</a></li>
                    <li><a href="issuereporting.php">Issue reporting</a></li>
                    <li><a href="cykel.php">Cykel</a></li>
                    <li><a href="socialmedia.php">Social media</a></li>
                    <?php if (admin_check($mysqli) == true) : ?> <li><a href="admin.php">Admin</a></li> <?php endif; ?>
            </ul>
        </div>

        
</div>





</header>

</div>
<div id="border-container">
    <div id="border"></div>
</div>



<!---
    
<div id="header-container">
    <div class="container">
        <form class="searchbar">
            <input type="text" class="searchbar knapp" value="Seach on Uppsala.se"/>
        </form>

        <img id="kommunLogga" src="https://www.uppsala.se/Content/Images/logo_neg.png" alt="Uppsala kommuns logotyp">

        <div id="topMenu" role="navigation">
            <div><a class="rubriker" href="../../issuereporting/">Map</a></div>
            <div><a class="rubriker" href="IssueReport.html">Issues</a></div>
            <div><a class="rubriker" href="IssueReport.html">Contact</a></div>
            <div><a class="rubriker" href="IssueReport.html">Language</a></div>
        </div>
         


    </div>

</div>

-->
