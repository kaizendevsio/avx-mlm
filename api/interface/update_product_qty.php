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
if (isset($_POST['product_id'])){$postData->product_id = $_POST['product_id'];}
if (isset($_POST['amount'])){$postData->amount = cleanString($_POST['amount']);}
if (isset($_POST['remarks'])){$postData->remarks = $_POST['remarks'];}

$response = '';
//$userAccount = new accounts();
//$userAccount->findById($postData->account_code);
//$response = $userAccount->upgrade($postData->ticket_code);

//$userAccount = new accounts;
//$userAccount->findById($postData->account_code);
//$userAccount->executeUniLevel();

$product = new products;
$product->setProductBalance($postData->product_id,$postData->amount);

$sysLog = new system_logs;
$sysLog->createLog("", "Product balance has been set to " . $postData->amount . " with product id " . $postData->product_id . ". Remarks: " . $postData->remarks , "SET_PRODUCT_BALANCE", "1", "NO" , "2",'',$postData->amount, '1','1');

$response = '200';

//REPLY BACK TO CLIENT
$resultData = new StdClass;
$resultData->status = $response;

$JSONdata = json_encode($resultData);
echo $JSONdata;

?>