<?php

$m = new MongoClient();

if (isset($_POST['Description']) && isset($_POST['Longitude']) && isset($_POST['Latitude']) && isset($_POST['IssueCategory']) && isset($_POST['Timestamp'])) {
 	
    $UniqueID = $_POST['UniqueID'];
    $desc = $_POST['Description'];
    $long = $_POST['Longitude'];
    $lat = $_POST['Latitude'];
    $issueCategory = $_POST['IssueCategory'];
    $currentTime = $_POST['Timestamp'];
    $imageFile = $_POST['Picture'];

    $CommentMuni = "";
    $CompResp = "";
    $Group = "Issues";
    $Picture = $imageFile;
    $StatusMuni = "Inrapporterad";
    $Priority = "Nej";

    $db = $m->issuereporting;
    $collection = $db->report;

    $document = array(
	"UniqueID" =>$UniqueID,
	"Description" =>$desc,
	"Longitude" =>$long,
	"Latitude" =>$lat,
	"Category" =>$issueCategory,
	"Timestamp" =>$currentTime,
	"Comment_muni" =>$CommentMuni,
	"Comp_resp" =>$CompResp,
        "Group" =>$Group,
	"Picture" =>$Picture,
	"Status_muni" =>$StatusMuni,
    "Priority" =>$Priority
	);

    $collection->insert($document);

    } else {}
?>
