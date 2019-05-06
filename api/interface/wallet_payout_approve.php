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
if (isset($_POST['logID'])){$postData->logID = cleanString($_POST['logID']);}

$sysLog = new system_logs;
$sysLog->findById($postData->logID);


$response = '';


if ($sysLog->status != "OK")
{


$account = new accounts;
$account->findByUsername($sysLog->username);
$wallets = new wallet;

$wlt_pending_old = $wallets->getWalletBalance($account->userID,$wallets->getWalletID("MAIN_PENDING"));
$wlt_tlt_old = $wallets->getWalletBalance($account->userID,$wallets->getWalletID("MAIN_TLT"));

$wlt_pending = floatval($wlt_pending_old) - floatval($sysLog->value);
$wlt_tlt = floatval($wlt_tlt_old) + floatval($sysLog->value);

$wallets->setBalance($account->userID,$wlt_tlt,$wallets->getWalletID("MAIN_TLT"));
$wallets->setBalance($account->userID,$wlt_pending,$wallets->getWalletID("MAIN_PENDING"));

$response = $account->approvePayout($postData->logID,$account->userName);
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