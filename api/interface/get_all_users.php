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
if (isset($_POST['account_code'])){$postData->account_code = cleanString($_POST['account_code']);}

$allusers_OBJ = array();

if ($postData->intent != '')
{
    if($postData->intent == 'directs'){
        $response = '';
        $userAccount = new accounts();
        $allUsers = $userAccount->findById($postData->account_code);
        $allusers_unam = array();

        $length = count($allUsers->directs->items) - 1;
        $x = 0;
        $tmpLog = '';


        while ($x <= $length)
        {
            array_push($allusers_unam,$allUsers->directs->items[$x]->username);
            $x = $x + 1;
        }

        $allusers_OBJ = $allusers_unam;
        $response = '200';
    }
    else if($postData->intent == 'downline'){
        $response = '';
        $allusers_unam_reuslt = array();
        $allusers_unam_reuslt = getDL($postData->account_code);
        $allusers_OBJ  = str_getcsv($allusers_unam_reuslt);

        if ($allusers_OBJ[0] == null)
        {
            $allusers_OBJ = [];
        }


        $response = '200';
    }
    else if($postData->intent == 'raw'){
        $response = '';
        $userAccount = new accounts();
        $allUsers = $userAccount->getAllUsers();
        $allusers_unam = array();

        $length = count($allUsers) - 1;
        $x = 0;
        $tmpLog = '';


        while ($x <= $length)
        {
            array_push($allusers_unam,$allUsers[$x]);
            $x = $x + 1;
        }
        $allusers_OBJ = $allusers_unam;
        $response = '200';
    }
}
else{
    $response = '';
    $userAccount = new accounts();
    $allUsers = $userAccount->getAllUsers();
    $allusers_unam = array();

    $length = count($allUsers) - 1;
    $x = 0;
    $tmpLog = '';


    while ($x <= $length)
    {
        array_push($allusers_unam,$allUsers[$x]->username);
        $x = $x + 1;
    }
  $allusers_OBJ = $allusers_unam;
    $response = '200';
}


function getDL($account_code = ''){
    if ($account_code != '')
    {
        $userAccount = new accounts();
        $allUsers = $userAccount->findById($account_code);
        $allusers_unam = '';
        //$allusers_unam = $allUsers->userName . ' - ' . $allUsers->directs->count;
        global $allusers_OBJ;

        if ($allUsers->directs->count > 0)
        {
            $length = $allUsers->directs->count - 1;
            $x = 0;
            $tmpLog = '';


            while ($x <= $length)
            {
                $tmpData = getDL($allUsers->directs->items[$x]->account_code);
                if ($tmpData != '')
                {
                     if ($allusers_unam != '')
                     {
                         $allusers_unam = $allusers_unam . ',' . $tmpData;

                     }
                     else
                     {
                         $allusers_unam = $tmpData;

                     }

                }

                if ($allUsers->directs->items[$x]->username != '')
                {
                    if ($allusers_unam != '')
                    {
                        $allusers_unam = $allusers_unam . ',' . $allUsers->directs->items[$x]->username;

                    }
                    else{
                        $allusers_unam =  $allUsers->directs->items[$x]->username;

                    }


                }
                $x = $x + 1;
            }
              return $allusers_unam;
        }



    }



}



$resultData = new StdClass;
$resultData->status = $response;
$resultData->users = $allusers_OBJ;

$JSONdata = json_encode($resultData);
echo $JSONdata;

?>