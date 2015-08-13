<?php
function makestring($respArray){
    
$xArray = '[';
$yArray = '[';


foreach ($respArray as $key=>$value){
    $xArray .= '"' . $key . '",';
    $yArray .=  $value . ',';
}

$xString = substr($xArray, 0 , -1) . ']';
$yString = substr($yArray, 0 , -1) . ']';

$argString = "[" . $xString . "," . $yString . "]";
return $argString;
}

// Get cURL resource
function datamake($paramString,$paramArray){


$myData = array(
    'un' =>  $paramArray['un'],  
    'key' => $paramArray['key'],     
    'origin' => 'plot',
    'platform' => 'php',
    'args' => $paramString,
    'kwargs' => '{"filename" : ' . $paramArray['filename'] . ', 
                    "fileopt" : "overwrite",
                    "layout" : {
                                "title" : ' . $paramArray['title'] . ', "xaxis" : {"name" : "Date"}, "yaxis" : {"name" : "Number of Tweets"}
                    }
    }'

    );
    return $myData;
}

// $arrayinput is an array with keys [yyyy-mm-dd] and values int()
// $paramarray is an array with plotlysettings. ['un'] => 'your username', ['key'] => 'your secret plot.ly key'
// ['filename'] => '"your file name on plot.ly"' , ['title'] => '"your title on the plot"'
// NOTE: filename and title takes a "doublestring" ie. '"your title"' and not 'your title'
function uppdateplotly($arrayinput,$paramArray){
    $joinstring = makestring($arrayinput);
    $data = datamake($joinstring,$paramArray);
    $curl = curl_init();

// Set some options - we are passing in a useragent too here
    curl_setopt_array($curl, array(
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_URL => 'https://plot.ly/clientresp',
    CURLOPT_POST => 1,
    CURLOPT_POSTFIELDS => $data
    ));
// Send the request & save response to $resp
    $resp = curl_exec($curl);
// Close request to clear up some resources
    curl_close($curl);
}