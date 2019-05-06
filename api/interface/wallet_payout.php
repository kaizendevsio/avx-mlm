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
if (isset($_POST['payout_detail'])){$postData->payout_detail = $_POST['payout_detail'];}
if (isset($_POST['payout_mode'])){$postData->payout_mode = cleanString($_POST['payout_mode']);}
if (isset($_POST['payout_amount'])){$postData->payout_amount = abs(cleanString($_POST['payout_amount']));}
if (isset($_POST['account_code'])){$postData->account_code = cleanString($_POST['account_code']);}

$response = '';
$account = new accounts($postData->account_code);
$wallets = new wallet;

$wlt_pending_old = $wallets->getWalletBalance($account->userID,$wallets->getWalletID("MAIN_PENDING"));
$wlt_tlt_old = $wallets->getWalletBalance($account->userID,$wallets->getWalletID("MAIN"));

if (floatval($wlt_tlt_old) > 0 and floatval($wlt_tlt_old) >= floatval($postData->payout_amount))
{
$wlt_pending = floatval($wlt_pending_old) + floatval($postData->payout_amount);
$wlt_tlt = floatval($wlt_tlt_old) - floatval($postData->payout_amount);

$wallets->setBalance($account->userID,$wlt_tlt,$wallets->getWalletID("MAIN"));
$wallets->setBalance($account->userID,$wlt_pending,$wallets->getWalletID("MAIN_PENDING"));

$response = $account->requestPayout($postData->payout_mode, $postData->payout_amount,$postData->payout_detail);
}
else{
    $response = '500';
}





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