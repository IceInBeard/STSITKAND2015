<?php

function datemakerStandard($date){
    return date('d-m-Y H:i:s', strtotime($date));
}

function datemakerGraph($date){
	return date('Y-m-d', strtotime($date));
}

function dateGrouper($data,$datefield,$valuefield){
	$limitdate=datemakerStandard($data[0][$datefield] . "tomorrow");
	$currentdate=datemakerGraph($data[0][$datefield]);
	$temp=array();
	foreach($data as $point){
		if(datemakerStandard($point[$datefield]) >= $limitdate){
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

