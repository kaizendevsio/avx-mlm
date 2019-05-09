<?php
//// ELON FRAMEWORK
//// A LIGHTWEIGHT, FAST AND SECURE ALTERNATIVE PHP FRAMEWORK FOR DEVELOPING SERVER SIDE APPLICATIONS
//// MIC-BASED FRAMEWORK (MODEL-INTERFACE-CONTROLLER)

//// DEVELOPED BY XEON ERALDO
//// VERSION 0.3.1, JANUARY 2019

////===================================================================================================
//// LOAD ALL IMPORTS AND MODULES
include('../models/accounts.php');
include_once('../models/unit_test.php');
header('Content-Type: application/json');
$response = '';
$unitTest = new unitTest();

$unitTest->startIndex = 0;
$unitTest->userCreateCount = 20;
$unitTest->packagePremium_Count = 20;
$unitTest->packageBasic_Count = 0;
$unitTest->clientName = "POGI";

$response = $unitTest->start();



$resultData = new StdClass;
$resultData->status = $response->status;
$resultData->result = $response;

$JSONdata = json_encode($resultData);
echo $JSONdata;

$condition = false;
$result = $condition ? 1:0;

echo $result;

$result = 'not null';

$result = $result ?? 'null sya';

echo $result;

?>