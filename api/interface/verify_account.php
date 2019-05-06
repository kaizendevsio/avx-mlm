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
if (isset($_GET['account_code'])){$postData->account_code = cleanString($_GET['account_code']);}

$response = '';
$userAccount = new accounts();
$response = $userAccount->verifyAccount($postData->account_code);

//REPLY BACK TO CLIENT
$resultData = new StdClass;
$resultData->status = $response;

$JSONdata = json_encode($resultData);
echo $JSONdata;

?>