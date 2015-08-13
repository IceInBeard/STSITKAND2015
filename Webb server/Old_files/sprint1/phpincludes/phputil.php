<?php

function datemakerStandard($date){
    return date('d-m-Y H:i:s', strtotime($date));
}

function datemakerGraph($date){
	return date('Y-m-d', strtotime($date));
}

function dateGrouper($data,$datefield,$valuefield){
	$limitdate=datemakerStandard($data[0][$datefield] . 'tomorrow');
	$currentdate=datemakerGraph($data[0][$datefield]);
	$temp=array();
	foreach($data as $point){
		if(datemakerStandard($point[$datefield]) > $limitdate){
			$limitdate=datemakerStandard($point[$datefield] . 'tomorrow');
			$currentdate=datemakerGraph($point[$datefield]);
		}		
		$temp[$currentdate]=$temp[$currentdate]+$point[$valuefield];	
	}
	return $temp;
}

function addDateGroups($datarray){
    $temp = array();
    foreach($datarray as $array){
        foreach($array as $key => $val){
            $temp[$key] = $temp[$key] + $val;
        }
    }
    return $temp;
}


function tweetDataparser($rawdata,$criteriafunction1,$param1,$param2){
    $data = array();
    foreach($rawdata as $docs){
        if(is_null($criteriafunction1)||$criteriafunction1($docs[$param1],$param2)){
        $temp=array('Longitude' =>$docs['coordinates']['coordinates'][0],'Latitude' =>$docs['coordinates']['coordinates'][1],
        'Description'=>'Tweet', 'iconInfo' => 'twitter.png', 'Text' => $docs['text'],'Category' => null, 'Picture' => null,
        'user' => $docs['user_name'], 'date' => datemakerStandard($docs['created_at']) , 'value' => 1
        );
        array_push($data,$temp);
    }}
        return $data;
}

function tweetRefinedDataparser($indata,$criteriafunction,$param1,$param2){
    $utdata = array();
    foreach ($indata as $docs){
        if($criteriafunction($docs[$param1],$param2)){
            array_push($utdata,$docs);
        }
    }
    return $utdata;
}

function dataBaseCall($collectionName){
    $m = new MongoClient();
    $db = $m->selectDB('SocialMedia');
    $collection = new MongoCollection($db,$collectionName);
    $cursor = $collection->find();
    return $cursor;    
}



$wordcheck = function($text,$word){
    return (stripos($text,$word)!==false);
};

$datecheck= function($date,$bounds){
    return (datemakerStandard($date) >= $bounds[0] && datemakerStandard($date) < $bounds[1]);
};




$testfunc = function(){
  return "gustav";  
};

