<!DOCTYPE html>

<html>
<meta charset="UTF-8">
<head>
    <script
            src="http://maps.googleapis.com/maps/api/js">
    </script>
    <script src="pump.js"></script>


</head>

<body onload="onloading()">



<div id="googleMap" style="width:500px;height:380px;"></div>


Verkstad:<input type="checkbox" id="checkVerkstad" onchange="checkVerkstad()">

Pump:<input type="checkbox" id="checkPumps" onclick="checkPump()">

<?php include 'index.php';?>






</body>
</html>
