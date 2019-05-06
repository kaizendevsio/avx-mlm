<?php
// ELON FRAMEWORK
// A LIGHTWEIGHT, FAST AND SECURE ALTERNATIVE PHP FRAMEWORK FOR DEVELOPING SERVER SIDE APPLICATIONS
// MIC-BASED FRAMEWORK (MODEL-INTERFACE-CONTROLLER)

// DEVELOPED BY XEON ERALDO
// VERSION 0.3.1, JANUARY 2019

//===================================================================================================

// LOAD ALL IMPORTS AND MODULES
include('../controllers/main.php');
include('../models/wallet.php');
include('../routes/connection.php');
include('../routes/autoloads.php');


//GET FORM DATA
$postData = new StdClass;
if (isset($_POST['userid'])){$postData->userID = cleanString($_POST['userid']);}

$wallet = new wallet;
$status = '';
$message_txt = '';

//REPLY BACK TO CLIENT
$resultData = new StdClass;


if ($controllers->getWalletBalance() == 'OK')
{
    //GET MAIN WALLET BALANCE
    $resultData->main_balance = $wallet->getWalletBalance($postData->userID,$wallet->getWalletID('MAIN'));
    $resultData->matching_balance = $wallet->getWalletBalance($postData->userID,$wallet->getWalletID('MATCHING'));
    $resultData->PR_COUNTER = $wallet->getWalletBalance($postData->userID,$wallet->getWalletID('PR_COUNTER'));
    $resultData->sh_balance = $wallet->getWalletBalance($postData->userID,$wallet->getWalletID('SH'));
    $resultData->bp_balance = $wallet->getWalletBalance($postData->userID,$wallet->getWalletID('BP'));
    $resultData->ul_balance = $wallet->getWalletBalance($postData->userID,$wallet->getWalletID('UL'));
    $resultData->PRD_ITMS = $wallet->getWalletBalance($postData->userID,$wallet->getWalletID('PRD_ITMS'));
    $resultData->PRD_ITMS_UN = $wallet->getWalletBalance($postData->userID,$wallet->getWalletID('PRD_ITMS_UN'));
    $resultData->PRD_ITMS_TLT = $wallet->getWalletBalance($postData->userID,$wallet->getWalletID('PRD_ITMS_TLT'));
    $resultData->bp_prem_balance = $wallet->getWalletBalance($postData->userID,$wallet->getWalletID('BP_PREM'));
    $resultData->binary_pair_balance = $wallet->getWalletBalance($postData->userID,$wallet->getWalletID('PRB'));
    $resultData->binary_5thpair_balance = $wallet->getWalletBalance($postData->userID,$wallet->getWalletID('5PRB'));
    $resultData->dr_balance = $wallet->getWalletBalance($postData->userID,$wallet->getWalletID('DR'));
    $resultData->dl_count = $wallet->getWalletBalance($postData->userID,$wallet->getWalletID('DL_COUNT'));
    $resultData->pending_balance = $wallet->getWalletBalance($postData->userID,$wallet->getWalletID('MAIN_PENDING'));
    $resultData->cashout_balance = $wallet->getWalletBalance($postData->userID,$wallet->getWalletID('MAIN_TLT'));

    $status = '200';
    $message_txt = 'OK';
}
else{
    $status = '301';
    $message_txt = $controllers->getWalletBalance();
}




$resultData->status = $status;
$resultData->message = $message_txt;

$JSONdata = json_encode($resultData);
echo $JSONdata;

?>