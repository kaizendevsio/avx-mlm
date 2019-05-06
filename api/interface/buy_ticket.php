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
if (isset($_POST['account_code'])){$postData->account_code = cleanString($_POST['account_code']);}
if (isset($_POST['ticket_code'])){$postData->ticket_code = cleanString($_POST['ticket_code']);}

$response = '';
//$userAccount = new accounts();
//$userAccount->findById($postData->account_code);
//$response = $userAccount->upgrade($postData->ticket_code);

$sysLog = new system_logs;
$response = $sysLog->createLog("BUY CUPON", "A member with username: " . $username . " paid on " . $cPm . " with tx no.: " . $cTx . " to buy " . $cCount . " " . $cType . " cupons. Remarks: " .$cRemarks , "CASH_IN_CUPON", "1", "NO" , "2", "",$total_value , $cCount,$cType,$username);

//REPLY BACK TO CLIENT
$resultData = new StdClass;
$resultData->status = $response;

$JSONdata = json_encode($resultData);
echo $JSONdata;

?>