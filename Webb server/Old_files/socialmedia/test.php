
<html>

<head>
	<link href="jquery-ui.css" rel="stylesheet">
<link href="jquery-ui.theme.css" rel="stylesheet">
<link href="jquery-ui.structure.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="anvsida_.css">
<script src="jquery-1.11.2.js"></script>
<script src="jquery-1.11.2.min.js"></script>
<script src="jquery-ui.js"></script>
<script src="anvsida_.js"></script>
<script src="mickemap.js"></script>
<script src="socialmediajs.js"></script>
</head>

<body>

<input id="from" type="text" value="från">
<input id="to" type="text" value="till">
<button id="search">search</button>
<button id="next">next</button>
<button id="back">back</button>
<?php
/*function dataBaseCall($collectionName){
    $m = new MongoClient();
    $db = $m->selectDB('SocialMedia');
    $collection = new MongoCollection($db,$collectionName);
    $cursor = $collection->find();
    return $cursor;    
}

$myArray = dataBaseCall("coordTweets");

foreach ($myArray as $doc) {
	print_r($doc);

	# code...
}
*/
?>

</body>

</html>