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
if (isset($_POST['Name'])){$postData->Name = $_POST['Name'];}
if (isset($_POST['Description'])){$postData->Description = $_POST['Description'];}
if (isset($_POST['price'])){$postData->price = cleanString($_POST['price']);}
if (isset($_POST['qty'])){$postData->qty = cleanString($_POST['qty']);}
if (isset($_POST['type'])){$postData->type = $_POST['type'];}
if (isset($_POST['category'])){$postData->category = cleanString($_POST['category']);}
if (isset($_POST['status'])){$postData->status = cleanString($_POST['status']);}
if (isset($_POST['snapshot'])){$postData->snapshot = cleanString($_POST['snapshot']);}

$response = '';
$product = new products;
$response = $product->createProduct($postData);

$resultData = new StdClass;
$resultData->status = $response;

$JSONdata = json_encode($resultData);
echo $JSONdata;

?>