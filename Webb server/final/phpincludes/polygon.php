<?php





//Point-In-Polygon Algorithm
//$polySides  = 4; //how many corners the polygon has
//$polyX    =  array(4,9,11,2);//horizontal coordinates of corners
//$polyY    =  array(10,7,2,2);//vertical coordinates of corners

function pointInPolygon($area,$point) {
	$polySides = $area['polySides'];
	$polyX = $area['polyX'];
	$polyY = $area['polyY'];
	$x = $point[0];
	$y = $point[1];
  $j = $polySides-1 ;
  $oddNodes = 0;
  for ($i=0; $i<$polySides; $i++) {
    if ($polyY[$i]<$y && $polyY[$j]>=$y 
 ||  $polyY[$j]<$y && $polyY[$i]>=$y) {
    if ($polyX[$i]+($y-$polyY[$i])/($polyY[$j]-$polyY[$i])*($polyX[$j]-$polyX[$i])<$x)    {
    $oddNodes=!$oddNodes; }}
   $j=$i; }

  return $oddNodes; }
