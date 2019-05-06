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
$allTicket = '';

if ($postData->intent != '')
{
    if($postData->intent == 'raw'){
        $response = '';
        $userAccount = new tickets();
        $allTicket = $userAccount->getAllTicket();
        $allusers_unam = array();

        $response = '200';
    }
    else if($postData->intent == 'getPackage'){

        $getTicket = new tickets($postData->ticket_code);
        $accountPackage = 0;
        //return $getTicket;



        if ($getTicket->count == 0 Or $getTicket->ticket_status == 2 Or $getTicket->ticket_status == 3)
        {
            $response = '500';
            $allTicket = 0;
        }
        else{
            $package = new packages;
            $response = '200';

            //$accountPackage = $getTicket->ticket_type;
            $package->getPackageName($getTicket->ticket_type);
            $accountPackage = $package->name;

            $allTicket = $package;
        }
    }
}
else{

}


$resultData = new StdClass;
$resultData->status = $response;
$resultData->result = $allTicket;

$JSONdata = json_encode($resultData);
echo $JSONdata;

?>