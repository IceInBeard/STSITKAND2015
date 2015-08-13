<?php
   $array = array(
    "foo" => "bar",
    "bar" => "foo",
    100   => -100,
    -100  => 100,
);

foreach ($array as $i) {
	echo $i;
}

//echo json_encode();
?>
