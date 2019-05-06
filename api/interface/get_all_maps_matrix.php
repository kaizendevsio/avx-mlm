<?php
// ELON FRAMEWORK
// A LIGHTWEIGHT, FAST AND SECURE ALTERNATIVE PHP FRAMEWORK FOR DEVELOPING SERVER SIDE APPLICATIONS
// MIC-BASED FRAMEWORK (MODEL-INTERFACE-CONTROLLER)

// DEVELOPED BY XEON ERALDO
// VERSION 0.3.1, JANUARY 2019

//===================================================================================================
// LOAD ALL IMPORTS AND MODULES
include('../models/accounts.php');
header('Content-Type: application/json');

$postData = new StdClass;
$postData->intent = '';

if (isset($_POST['intent'])){$postData->intent = cleanString($_POST['intent']);}
if (isset($_POST['account_code'])){$postData->account_code = cleanString($_POST['account_code']);}

$allusers_OBJ = array();
$response = '';
$allTicket = '';

if ($postData->intent != '')
{
    if($postData->intent == 'raw'){
        $response = '';
        $userAccount = new maps();
        $MapStructure = $userAccount->GetMapDisplay($postData);

        $response = '200';
    }
    else if($postData->intent == 'downline'){

        $response = '';
        $userAccount = new maps();
        $MapStructure = $userAccount->GetMapDisplay($postData);

        $response = '200';

    }
}
else{

}


$resultData = new StdClass;
$resultData->status = $response;
$resultData->result = $MapStructure;

$JSONdata = json_encode($resultData);
echo $JSONdata;

?>