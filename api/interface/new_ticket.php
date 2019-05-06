<?php
// ELON FRAMEWORK
// A LIGHTWEIGHT, FAST AND SECURE ALTERNATIVE PHP FRAMEWORK FOR DEVELOPING SERVER SIDE APPLICATIONS
// MIC-BASED FRAMEWORK (MODEL-INTERFACE-CONTROLLER)

// DEVELOPED BY XEON ERALDO
// VERSION 0.3.1, JANUARY 2019

//===================================================================================================
// LOAD ALL IMPORTS AND MODULES
include('../models/accounts.php');


//GET FORM DATA
$postData = new StdClass;
if (isset($_POST['ticket_name'])){$postData->ticket_name = $_POST['ticket_name'];}
if (isset($_POST['ticket_type'])){$postData->ticket_type = cleanString($_POST['ticket_type']);}
if (isset($_POST['ticket_status'])){$postData->ticket_status = cleanString($_POST['ticket_status']);}
if (isset($_POST['ticket_created_by'])){$postData->ticket_created_by = cleanString($_POST['ticket_created_by']);}
if (isset($_POST['ticket_used_by'])){$postData->ticket_used_by = $_POST['ticket_used_by'];}
if (isset($_POST['ticket_value'])){$postData->ticket_value = cleanString($_POST['ticket_value']);}
if (isset($_POST['ticket_use_case'])){$postData->ticket_use_case = cleanString($_POST['ticket_use_case']);}
if (isset($_POST['ticket_owner'])){$postData->ticket_owner = cleanString($_POST['ticket_owner']);}
if (isset($_POST['ticket_pcs'])){$postData->ticket_pcs = cleanString($_POST['ticket_pcs']);}

$response = '';
$tickets = new tickets();
$response = $tickets->createTicket($postData->ticket_name,$postData->ticket_type, $postData->ticket_status,$postData->ticket_created_by,$postData->ticket_used_by,$postData->ticket_value,$postData->ticket_use_case,$postData->ticket_owner,$postData->ticket_pcs);

//}

//$userAccount->findById('4tSZYzuPskqnmIhk3b8VlIASCLKpFkbfSRZA5jM9CbEbkqanyvrX9o4Esy9FjYfJ');
//$response = $userAccount->directs->items;
//$response = $userAccount->checkDirectsPackages('4tSZYzuPskqnmIhk3b8VlIASCLKpFkbfSRZA5jM9CbEbkqanyvrX9o4Esy9FjYfJ');

//REPLY BACK TO CLIENT
$resultData = new StdClass;
$resultData->status = $response;

$JSONdata = json_encode($resultData);
echo $JSONdata;

?>