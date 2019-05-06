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
$response = '';
$Account = new accounts();
$allUsers = $Account->getAllUsers();
$length = count($allUsers) - 1;
$x = 0;
$tmpLog = '';


while ($x < $length)
{
    $account_code = $allUsers[$x]->account_code;
    $response = $response . 'USER: ' . $account_code. ' <br>';
    $wallet_MAKE = new wallet($account_code,'BP_COUNTER');
    $response = $response . 'WALLET MAKE: BP_COUNTER - 200 <br>';

    $x = $x + 1;
}


$resultData = new StdClass;
$resultData->status = $response;

$JSONdata = json_encode($resultData);
echo $JSONdata;

?>