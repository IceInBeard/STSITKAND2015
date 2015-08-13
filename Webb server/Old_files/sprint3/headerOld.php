<?php

include_once 'inloggad/includes/psl-config.php';
include_once 'inloggad/includes/db_connect.php';
include 'inloggad/includes/functions.php';

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Uppsala Smart City</title>

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





    <!-- CSS -->
    <link type="text/css" rel="stylesheet" href="css/headerStyle.css">
    <link type="text/css" rel="stylesheet" href="css/struktur.css">
    <link type="text/css" rel="stylesheet" href="css/map.css">

    <link type="text/css" rel="stylesheet" href="css/socialmedia.css">
    <link type="text/css" rel="stylesheet" href="jqueryui/jquery-ui.min.css">

    <link type="text/css" rel="stylesheet" href="css/issuereporting.css">

    <link type="text/css" rel="stylesheet" href="css/cykel.css">
    <link rel="stylesheet" type="text/css" href="css/vader.css">
    <link href="jQRangeSlider-5.7.1/css/iThing-min.css" rel="stylesheet">

    <link rel="stylesheet" type="text/css" href="css/servicemessage.css">

    <link rel="stylesheet" type="text/css" href="css/forms.css">





    <!-- JavaScript -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDMbQF_U346cDNgBehK5fHOVi9rby-Bak4&libraries=visualization&sensor=true_or_false&v=3.0"></script>
	
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>
    <script src="jqueryui/jquery-ui.min.js" type="text/javascript"></script>
    <script src="jQRangeSlider-5.7.1/jQDateRangeSlider-min.js"></script>


    <script type="text/javascript" src="jqueryui/jquery.simpleWeather.js"></script>
    <script type="text/javascript" src="jqueryui/jquery.simpleWeather.min.js"></script>
    <script type="text/javascript" src='Chart.js-master/Chart.js'></script>
    <script type="text/javascript" src="js/mapFunc.js"></script>
    <script type="text/javascript" src="js/issues.js"></script>
    <script type="text/javascript" src="js/bicycle.js"></script>
    <script type="text/javascript" src="js/vader.js"></script>
    <script type="text/javascript" src='js/wordcloud.js'></script>
    <script type="text/javascript" src = 'js/wordcounter.js'></script>
    <script type="text/javascript" src = 'js/stopwords.js'></script>
    <script type="text/javascript" src='js/loadingani.js'></script>
    <script type="text/javascript" src='js/pageload.js'></script>

   <!-- <script type="text/javascript" src="js/widgetcontrol.js"></script> -->
    <script type="text/javascript" src="js/socialmedia.js"></script>

    <script type="text/javascript" src="js/tabmenu.js"></script>

    <!--fancybox-->
    <script type="text/javascript" src="fancybox/source/jquery.fancybox.js?v=2.1.5"></script>
    <link rel="stylesheet" type="text/css" href="fancybox/source/jquery.fancybox.css?v=2.1.5" media="screen" />
    <script type="text/javascript" src="fancybox/source/ourfancybox.js"></script>
    <script type="text/javascript" src="fancybox/lib/jquery.mousewheel-3.0.6.pack.js"></script>
    <link rel="stylesheet" type="text/css" href="fancybox/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" />
    <script type="text/javascript" src="fancybox/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
    <link rel="stylesheet" type="text/css" href="fancybox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" />
    <script type="text/javascript" src="fancybox/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>
    <script type="text/javascript" src="fancybox/source/helpers/jquery.fancybox-media.js?v=1.0.6"></script>


    <script type="text/javascript" src="js/timeslider.js"></script>


</head>

<body onload="onloading()">
    <body>

<div id="header-container">
        <header id="top" class="clearfix" role="banner">
    <a href="/">
        <img src="img/UppsalaSmartCityWhite.png" alt="Uppsala kommuns logotyp">
    </a> 

    <div id="topMenu">
        <a href="https://www.uppsala.se/" target="_blank" class="icon-home"></a>
        <a href="https://sv-se.facebook.com/uppsalakommun" target="_blank" class="icon-facebook2"></a>
        <a href="https://instagram.com/uppsalakommun/" target="_blank" class="icon-instagram"></a>
        <a href="https://twitter.com/uppsalakommun" target="_blank" class="icon-twitter2"></a>
    </div>


</div>


  

</header>

</div>
<div id="border-container">
    <div id="border"></div>
</div>

