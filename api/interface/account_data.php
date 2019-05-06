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

$wallet = new wallet;
$package = new packages;
$status = '';
$message_txt = '';

//REPLY BACK TO CLIENT
$resultData = new StdClass;


if ($controllers->findByUserID() == 'OK')
{
    $account = new accounts($postData->userID);

    $resultData->account_directs = $account->directs->count;
    $resultData->account_package = $package->getPackageName($account->account_package);
    $resultData->account_email = $account->email;
    $resultData->account_fullname = $account->fullname;
    $resultData->account_created = $account->dtCreated;
    $resultData->account_token = $account->account_token;
    $resultData->account_code = $account->userID;
    $resultData->account_username = $account->userName;
    $resultData->account_type = $account->account_type;

    $status = '200';
    $message_txt = 'OK';
}
else{
    $status = '301';
    $message_txt = $controllers->findByUserID();
}




$resultData->status = $status;
$resultData->message = $message_txt;

$JSONdata = json_encode($resultData);
echo $JSONdata;

?>