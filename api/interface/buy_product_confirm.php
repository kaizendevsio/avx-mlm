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
if (isset($_POST['account_code'])){$postData->account_code = cleanString($_POST['account_code']);}

$response = '';
$userAccount = new accounts();
$userAccount->findById($postData->account_code);


$product = new products;
$product->getByProductID($postData->product_id);
$product->consume($postData->product_id, $postData->amount, $postData->account_code);

$wallet = new wallet;
$unilevel_repeat = $wallet->getWalletBalance($userAccount->userID,$wallet->getWalletID('PRD_ITMS'));
$initWalletBalance = $unilevel_repeat;
$finalWalletBalance = 0;
$unilevel_repeat = ($unilevel_repeat / 2);

if (isInteger($unilevel_repeat))
{
    $finalWalletBalance = $initWalletBalance;
}
else{
    $finalWalletBalance = floatval($initWalletBalance) - 1;
}

$unilevel_repeat = floor($unilevel_repeat);

for ($i = 0; $i < $unilevel_repeat; $i++)
{
	$userAccount->executeUniLevel();
}

$wallet->setBalance($userAccount->userID,($initWalletBalance - $finalWalletBalance),$wallet->getWalletID('PRD_ITMS'));

$sysLog = new system_logs;
$response = $sysLog->createLog("", "A member with username: " . $userAccount->userName . " confirmed purchase of " . $postData->amount . " products." , "PRODUCT_BUY_CONFIRM", "1", "NO" , "OK", "",$postData->amount , '1', '1' ,$userAccount->userName);

//REPLY BACK TO CLIENT
$resultData = new StdClass;
$resultData->status = $response;

$JSONdata = json_encode($resultData);
echo $JSONdata;

?>