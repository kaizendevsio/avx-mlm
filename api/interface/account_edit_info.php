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
if (isset($_POST['userid'])){$postData->userID = cleanString($_POST['userid']);}
if (isset($_POST['intent'])){$postData->intent = cleanString($_POST['intent']);}
if (isset($_POST['args'])){$postData->args = $_POST['args'];}

$wallet = new wallet;
$package = new packages;
$status = '';
$message_txt = '';

//REPLY BACK TO CLIENT
$resultData = new StdClass;

$account = new accounts();
$status =  '200';
$message_txt = $account->editInfo($postData->userID,$postData->intent,$postData->args);

$resultData->status = $status;
$resultData->message = $message_txt;

$JSONdata = json_encode($resultData);
echo $JSONdata;

?>