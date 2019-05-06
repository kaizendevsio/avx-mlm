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
$postData = new user;
if (isset($_POST['fn'])){$postData->FirstName = cleanString($_POST['fn']);}
if (isset($_POST['mn'])){$postData->MiddleName = cleanString($_POST['mn']);}
if (isset($_POST['ln'])){$postData->LastName = cleanString($_POST['ln']);}
if (isset($_POST['nn'])){$postData->NickName = cleanString($_POST['nn']);}
if (isset($_POST['email'])){$postData->Email = $_POST['email'];}
if (isset($_POST['phone'])){$postData->Phone = cleanString($_POST['phone']);}
if (isset($_POST['gender'])){$postData->Gender = cleanString($_POST['gender']);}
if (isset($_POST['data_pass'])){$postData->Password = cleanString($_POST['data_pass']);}
if (isset($_POST['data_username'])){$postData->UserName = cleanString($_POST['data_username']);}
if (isset($_POST['uplineID'])){$postData->UplineAccountCode = cleanString($_POST['uplineID']);}
if (isset($_POST['ticket_code'])){$postData->TicketCode = cleanString($_POST['ticket_code']);}
if (isset($_POST['matrix_upline'])){$postData->MatrixUpline = cleanString($_POST['matrix_upline']);}
if (isset($_POST['position'])){$postData->Position = cleanString($_POST['position']);}

$userAccount = new accounts();
$userAccount->findByUsername($postData->UplineAccountCode);
$postData->UplineAccountCode = $userAccount->userID;

$response = '';
$response = $userAccount->newUser($postData);

//REPLY BACK TO CLIENT
$resultData = new StdClass;
$resultData->status = $response;

$JSONdata = json_encode($resultData);
echo $JSONdata;

?>