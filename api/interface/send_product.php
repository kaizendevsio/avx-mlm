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
if (isset($_POST['from'])){$postData->from = cleanString($_POST['from']);}
if (isset($_POST['product_id'])){$postData->product_id = $_POST['product_id'];}
if (isset($_POST['amount'])){$postData->amount = cleanString($_POST['amount']);}
if (isset($_POST['to'])){$postData->to = cleanString($_POST['to']);}
if (isset($_POST['remarks'])){$postData->remarks = $_POST['remarks'];}

$response = '';
//$userAccount = new accounts();
//$userAccount->findById($postData->account_code);
//$response = $userAccount->upgrade($postData->ticket_code);

//$userAccount = new accounts;
//$userAccount->findById($postData->account_code);
//$userAccount->executeUniLevel();

$account = new accounts;
$account->findByUsername($postData->to);
$postData->to = $account->userID;

$product = new products;
$product->send($postData->product_id, $postData->amount, $postData->from, $postData->to);

$sysLog = new system_logs;
$sysLog->createLog("", "Product has been sent from: " . $postData->from . " to " . $postData->to . " with product id " . $postData->product_id . " and total amount of  " . $postData->amount . ". Remarks: " . $postData->remarks , "SEND_PRODUCT", "1", "NO" , "2",'',$postData->amount, '1','1');

$response = '200';
//REPLY BACK TO CLIENT
$resultData = new StdClass;
$resultData->status = $response;

$JSONdata = json_encode($resultData);
echo $JSONdata;

?>