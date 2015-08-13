<?php

function datemakerStandard($date){
    return date('d-m-Y H:i:s', strtotime($date));
}

function datemakerSend($date){
    return date('Y-m-d', strtotime($date));
}

function datemakerGraph($date){
	return date('Y-m-d', strtotime($date));
}

function dateGrouper($data,$datefield,$valuefield){
	$limitdate=new DateTime(datemakerStandard($data[0][$datefield] . 'tomorrow'));
	$currentdate=datemakerGraph($data[0][$datefield]);
	$temp=array();
	foreach($data as $point){
		if(new DateTime(datemakerStandard($point[$datefield])) > $limitdate){
			$limitdate=new DateTime(datemakerStandard($point[$datefield] . 'tomorrow'));
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
        'Text' => $docs['text'],'user' => $docs['user_name'], 'date' => datemakerStandard($docs['created_at']) ,
        'jsdate' => datemakerSend($docs['created_at']), 'value' => 1
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



$wordcheck = function($text,$words){
    $returnbol=false;
    foreach ($words as $word){
        if (stripos($text,$word)!==false){
            $returnbol = true;
        }
    }
    return $returnbol;
};

$datecheck= function($date,$bounds){
    return (new DateTime(datemakerStandard($date)) >= new DateTime($bounds[0]) && new DateTime(datemakerStandard($date)) < new DateTime($bounds[1]));
};




$testfunc = function(){
  return "gustav";  
};

