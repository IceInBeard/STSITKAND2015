<?php

//File that echoes out the start part head part of the html
echo "
<!DOCTYPE HTML>
<html>
<head>
    <script type='text/javascript' src='https://maps.googleapis.com/maps/api/js?key=AIzaSyDMbQF_U346cDNgBehK5fHOVi9rby-Bak4'>
    </script>

    <meta charset='UTF-8'>

<title>Uppsala Municipality</title>	
<link rel='stylesheet' type='text/css' href='anvsida_.css'>
    <script src='jquery-1.11.2.js'></script>
<script src='anvsida_.js'></script>
<script src='mappoints.js'></script>
<--script src='datatomap.js'script--?-->
<script type='text/javascript' src='mapFunc.js'>
</script>
<script type='text/javascript' src='issues.js'>
</script>
<script type='text/javascript' src='../cykel/bicycle.js'>
</script>

</head>

<body onload='onloading()'>

<div id='header-container'>
    <header id='top'>

        <img id='kommunLogga' src='https://www.uppsala.se/Content/Images/logo_neg.png' alt='Uppsala kommuns logotyp'>

        <div id='topMenu' role='navigation'>
            <div><a class='rubriker' href='index.php'>Hem</a></div>
	    <div><a class='rubriker' href='map.php'>Statestik</a></div>
            <div><a class='rubriker' href='map.php'>Kontakt</a></div>
        </div>

        <form class='searchbar'>
            <input type='text' class='searchbar knapp' value='Seach on Uppsala.se'/>
        </form>

    </header>
</div>

<div id='border-container'>
    <div class='gulkant'>
    </div>
</div>

</body>

</html>";
     ?>
