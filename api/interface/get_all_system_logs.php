<?php
// ELON FRAMEWORK
// A LIGHTWEIGHT, FAST AND SECURE ALTERNATIVE PHP FRAMEWORK FOR DEVELOPING SERVER SIDE APPLICATIONS
// MIC-BASED FRAMEWORK (MODEL-INTERFACE-CONTROLLER)

// DEVELOPED BY XEON ERALDO
// VERSION 0.3.1, JANUARY 2019

//===================================================================================================
// LOAD ALL IMPORTS AND MODULES
include('../models/accounts.php');

$postData = new StdClass;
$postData->intent = '';

if (isset($_POST['intent'])){$postData->intent = cleanString($_POST['intent']);}
if (isset($_POST['ticket_code'])){$postData->ticket_code = cleanString($_POST['ticket_code']);}

$allusers_OBJ = array();
$response = '';
$result = '';

if ($postData->intent != '')
{
    if($postData->intent == 'raw'){
        $response = '';
        $sysLog = new system_logs;
        $result = $sysLog->getAllLogs();

        $response = '200';
    }
    else if($postData->intent == 'payouts'){

        $response = '';
        $sysLog = new system_logs;
        $result = $sysLog->getPayoutLogs();

        $response = '200';
    }
}
else{

}


$resultData = new StdClass;
$resultData->status = $response;
$resultData->result = $result;

$JSONdata = json_encode($resultData);
echo $JSONdata;

?>