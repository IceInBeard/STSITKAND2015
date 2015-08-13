<?php
/* 
Function that returns the logged-in users id, name and admin status
as a json object. Primarily used by issuereporting backoffice
*/

include_once '../includes/db_connect.php';
include_once '../includes/functions.php';

 
sec_session_start();

$sesionArray = array (
    "user_id"  => $_SESSION['user_id'],
    "user_name" => $_SESSION['username'],
    "admin"   => $_SESSION['admin']
);


echo json_encode($sesionArray);

?>