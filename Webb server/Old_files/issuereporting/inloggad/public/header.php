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

    <link type="text/css" rel="stylesheet" href="http://stsitkand.student.it.uu.se/sprint1/css/struktur.css">
    <link type="text/css" rel="stylesheet" href="http://stsitkand.student.it.uu.se/sprint1/inloggad/public/css/form.css">
    <!-- <link type="text/css" rel="stylesheet" href="css/kommunvyNyHeader.css"> -->
    <link type="text/css" rel="stylesheet" href="http://stsitkand.student.it.uu.se/sprint1/inloggad/public/css/headerStyle.css">


    
   
    
    
</head>

<body>

<div id="header-container">
        <header id="top" class="clearfix" role="banner">
    <a href="/">
        <img src="img/UppsalaKommunLogoNeg.png" alt="Uppsala kommuns logotyp">
    </a>
       

       

        <div id="topMenu" role="navigation">
            <?php if (login_check($mysqli) == true) : ?> 
                   <nav class="dropDownHeader">
                        <ul class="LevelOneMeny">
                            <li class="dropDownMeny"><a href="index.php">Start</a></li>
                            <li class="dropDownMeny"><a href="#">Funktioner</a>
                            <ul class="LevelTwoMeny">
                                <li class="dropDownMeny"><a href="../../index.php">Karta</a>
                                <li class="dropDownMeny"><a href="http://stsitkand.student.it.uu.se/issuereporting/">Issue reporting</a></li>
                                <li class="dropDownMeny"><a href="socialmedia.php">Sociala medier</a></li>
                                <li class="dropDownMeny"><a href="http://stsitkand.student.it.uu.se/cykel/indexBicycle.php">Cykel</a>
                                <?php if (admin_check($mysqli) == true) : ?><li class="dropDownMeny"><a href="admin.php">Admin</a><?php endif; ?>

                                </li>
                            </ul>
                            </li>
                            <li class="dropDownMeny"><a href="#">Min profil</a>
                            <ul class="LevelTwoMeny">
                                    <li class="dropDownMeny"><a href="changePass.php">Byt lösenord</a></li>
                                    <li class="dropDownMeny"><a href="../includes/logout.php">Logga ut</a></li>
                            </ul>
                            </li>
                        </ul>
                    </nav>
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

