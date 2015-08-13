<!-- This is the standard header for all pages on the website. It creates a header with a drop down meny of links
    to all the parts of the website. It is included in all the other pages -->

<?php
include_once '../includes/db_connect.php';
include_once '../includes/functions.php';

// Calls the sec_session_start() function in ../includes/functions.php that starts a session for the login related variables  
sec_session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Smarta uppsala</title>

        <!-- Icons  -->
    <link rel="apple-touch-icon" sizes="57x57" href="img/icons/apple-touch-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="img/icons/apple-touch-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="img/icons/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="img/icons/apple-touch-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="img/icons/apple-touch-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="img/icons/apple-touch-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="img/icons/apple-touch-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="img/icons/apple-touch-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="img/icons/apple-touch-icon-180x180.png">
    <link rel="icon" type="image/png" href="img/icons/favicon-32x32.png" sizes="32x32">
    <link rel="icon" type="image/png" href="img/icons/android-chrome-192x192.png" sizes="192x192">
    <link rel="icon" type="image/png" href="img/icons/favicon-96x96.png" sizes="96x96">
    <link rel="icon" type="image/png" href="img/icons/favicon-16x16.png" sizes="16x16">
    <link rel="manifest" href="img/icons/manifest.json">
    <link rel="shortcut icon" href="img/icons/favicon.ico">
    <meta name="msapplication-TileColor" content="#005388">
    <meta name="msapplication-TileImage" content="img/icons/mstile-144x144.png">
    <meta name="msapplication-config" content="img/icons/browserconfig.xml">
    <meta name="theme-color" content="#ffffff">
    

    <!-- Main JS -->
    <script src="//code.jquery.com/jquery-2.1.3.min.js"></script>
    <script type="text/JavaScript" src="js/sha512.js"></script> 
    <script type="text/JavaScript" src="js/forms.js"></script>
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDMbQF_U346cDNgBehK5fHOVi9rby-Bak4"></script>
    
    <!-- Main CSS -->
    <link type="text/css" rel="stylesheet" href="css/struktur.css">
    <link type="text/css" rel="stylesheet" href="css/form.css">
    <link type="text/css" rel="stylesheet" href="css/headerStyle.css">
    <link type="text/css" rel="stylesheet" href="css/backoffice.css">


    <!-- Fancybox JS and CSS -->
    <script type="text/javascript" src="fancybox/source/jquery.fancybox.js?v=2.1.5"></script>
    <link rel="stylesheet" type="text/css" href="fancybox/source/jquery.fancybox.css?v=2.1.5" media="screen" />
    <script type="text/javascript" src="fancybox/source/ourfancybox.js"></script>
    <script type="text/javascript" src="fancybox/lib/jquery.mousewheel-3.0.6.pack.js"></script>
    <link rel="stylesheet" type="text/css" href="fancybox/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" />
    <script type="text/javascript" src="fancybox/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
    <link rel="stylesheet" type="text/css" href="fancybox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" />
    <script type="text/javascript" src="fancybox/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>
    <script type="text/javascript" src="fancybox/source/helpers/jquery.fancybox-media.js?v=1.0.6"></script>


    <!-- Issue JS -->
    <script type="text/javascript" src="js/anvsida_.js"></script>
    <script type="text/javascript" src="js/mapFunc.js"></script>
    
    <script type="text/javascript" src="js/dataTables.js"></script> 
    <script type="text/javascript" src="js/Filter.js"></script> 

    <!-- Social Media JS 
    <script type="text/javascript" src="js/socialmedia.js"></script>
-->
    <!-- Issue CSS -->
    <link type="text/css" rel="stylesheet" href="css/tablestyle.css">

    <!-- Cykel JS -->
   

    <!-- Cykel CSS -->
     <link type="text/css" rel="stylesheet" href="css/cykelbackoffice.css">

    <!-- Social Media CSS -->
    <link type="text/css" rel="stylesheet" href="css/socialbackoffice.css">
 

</head>

<body>

<div id="header-container">
        <header id="top" class="clearfix" role="banner">
    <a href="index.php">
        <img src="img/UppsalaSmartCityWhite.png" alt="Uppsala Smart City">
    </a>
       

       

        <div id="topMenu" role="navigation">
            <!-- Check if the user is logged in, else hides the menys on the header. Using the login_check function from ../includes/functions.php.  -->
            <?php if (login_check($mysqli) == true) : ?> 
                   <nav class="dropDownHeader">
                        <ul class="LevelOneMeny">
                            <li class="dropDownMeny"><a href="index.php">Start</a></li>
                            <li class="dropDownMeny"><a href="#">Funktioner</a>
                            <ul class="LevelTwoMeny">
                                <li class="dropDownMeny"><a href="../../index.php">Karta</a>
                                <li class="dropDownMeny"><a href="issuereporting.php">Felrapportering</a></li>
                                <!--<li class="dropDownMeny"><a href="../../index.php">Sociala medier</a></li>-->
                                <li class="dropDownMeny"><a href="cykel.php">Cykel</a>
                                <!-- Check if the logged in user is a admin, else hides the admin button. Using the dmin_check function from ../includes/functions.php. -->
                                <?php if (admin_check($mysqli) == true) : ?><li class="dropDownMeny"><a href="admin.php">Admin</a><?php endif; ?>

                                </li>
                            </ul>
                            </li>
                            

                            <li class="dropDownMeny"><a href="#"><strong><?php echo $_SESSION['username']; ?></strong></a>
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



