<?php
// ELON FRAMEWORK
// A LIGHTWEIGHT, FAST AND SECURE ALTERNATIVE PHP FRAMEWORK FOR DEVELOPING SERVER SIDE APPLICATIONS
// MIC-BASED FRAMEWORK (MODEL-INTERFACE-CONTROLLER)

// DEVELOPED BY XEON ERALDO
// VERSION 0.3.1, JANUARY 2019

//===================================================================================================

// LOAD ALL IMPORTS AND MODULES
use PHPMailer\PHPMailer\PHPMailer;

include('../controllers/main.php');
include('../models/system_logs.php');
include('../models/directs.php');
include('../models/app.php');
include('../models/packages.php');
include('../models/products.php');
include('../models/matix.php');
include('../models/maps.php');
include('../routes/connection.php');
include('../routes/autoloads.php');

if ($_isDebug == false)
{
    require '../../vendor/autoload.php';
}

class accounts{

    function __construct($userID = ''){
        $this->parentID = '';
        $this->userID = '';
        $this->userName = '';
        $this->directs = [];
        $this->wallet = [];
        $this->history = [];
        $this->dtCreated = '';
        $this->dtLastLogon = '';
        $this->account_package = '';
        $this->account_token = '';
        $this->lastUpdate = '';
        $this->lastUpdateDetail = '';
        $this->account_code = '';

        if (isset($userID))
        {
            if ($userID != '')
            {
                $this->findById($userID);
            }

        }
        return $this;
    }

    function newUser($options){
        global $controllers;
        global $_datetime;
        global $ipaddress_data;
        global $_isDebug;

        if ($controllers->newAccount() == 'OK')
        {
            $this->userID = generateRandomString(64);
            $newUserId =  $this->userID;
            $package = new packages;
            $sysLog = new system_logs;
            $matrix = new matrix;
            $maps = new maps;

            $accountPackage = '';
            $levelCountMax = 5;
            $levelCount = 0;
            $isMatched = false;
            $getTicket = new tickets($options->TicketCode);
            //return $getTicket;

            if ($_isDebug == false)
            {
                // CONSUME TICKET (CODE)
                if ($getTicket->count == 0 Or $getTicket->ticket_status == 2 Or $getTicket->ticket_status == 3)
                {
                    return 'CUPON ERR';
                }
                else{
                    //PROCEED TO CODE..
                    $accountPackage = $getTicket->ticket_type;
                }

                $package->getPackageName($accountPackage);
            }
            else{
                $package->getPackageName($package->getPackageID('GOLD'));
                $accountPackage = $package->packageID;
            }

            $data = [
             'fname' => $options->FirstName,
             'mname' => $options->MiddleName,
             'lname' => $options->LastName,
             'nname' => $options->NickName,
             'email' => $options->Email,
             'cp_no' => $options->Phone,
             'gender' => $options->Gender,
             'psw' => md5($options->Password),
             'username' => $options->UserName,
             'account_code' => $this->userID,
             'upline_account_code' => $options->UplineAccountCode,
             'account_created' => $_datetime,
             'account_type' => $options->AccountType,
             'account_package' => $accountPackage,
             'ipadd' => $ipaddress_data,
             'account_status' => '1'
             ];

            if ($controllers->newAccount->stmt->execute($data))
            {
                $getTicket->consume($this->userID);

                // FORCE VERIFY ACCOUNT
                $this->verifyAccount($this->userID);

                $sysLog->createLog("New member signup", "A new user registered with username: " . $options->UserName . " with package: " . $package->name, "USER_SIGNUP", "1", "NO", "OK", "","", "","");

                // =========== CREATE WALLETS ==============

                //MAIN WALLET
                $wallet_MAKE = new wallet($this->userID,'MAIN');

                //DR WALLET
                $wallet_MAKE = new wallet($this->userID,'DR');

                //DR COUNTER FOR MATCHING BONUS
                $wallet_MAKE = new wallet($this->userID,'DR_COUNT');

                //DR COUNTER FOR MATCHING BONUS
                $wallet_MAKE = new wallet($this->userID,'PRD_ITMS');

                //DR COUNTER FOR MATCHING BONUS
                $wallet_MAKE = new wallet($this->userID,'PRD_ITMS_UN');

                //DR COUNTER FOR MATCHING BONUS
                $wallet_MAKE = new wallet($this->userID,'PRD_ITMS_TLT');

                //LEVEL COUNTER FOR SHARE HOLDER BONUS
                $wallet_MAKE = new wallet($this->userID,'LEVEL_COUNT');

                //DOWNLINE COUNTER FOR SHARE HOLDER BONUS
                $wallet_MAKE = new wallet($this->userID,'DL_COUNT');

                //TOTAL CASHOUT COUNTER
                $wallet_MAKE = new wallet($this->userID,'MAIN_TLT');

                //PENDING COUNTER FOR WITHDRAWAL
                $wallet_MAKE = new wallet($this->userID,'MAIN_PENDING');

                //PENDING COUNTER FOR WITHDRAWAL
                $wallet_MAKE = new wallet($this->userID,'PAIR_COUNTER');

                //PENDING COUNTER FOR WITHDRAWAL
                $wallet_MAKE = new wallet($this->userID,'PRB');

                //PENDING COUNTER FOR WITHDRAWAL
                $wallet_MAKE = new wallet($this->userID,'5PRB');

                //PENDING COUNTER FOR WITHDRAWAL
                $wallet_MAKE = new wallet($this->userID,'PR_COUNTER');

                //ADD TO UPLINE
                $wallet = new wallet;

                //ADD DIRECT REFFERAL BONUS
                $user_dr = floatval($package->value) * (.10);

                $wallet->topUp($options->UplineAccountCode,($user_dr),$wallet->getWalletID('DR'),true);
                $wallet->topUp($options->UplineAccountCode,1,$wallet->getWalletID('DR_COUNT'));


                // CREATE NEW MATRIX INSTANCE
                $node = new Node;

                $node->account_code = $this->userID;
                $node->binaryCount_left = 0;
                $node->binaryCount_right = 0;
                $node->binaryPosition = $options->Position;

                $matrix->CreateNode($node);
                $maps->CreateBinaryNode($node);


                // EXECUTE BINARY PAIRING
                $this->executeBinaryPairing($options);
                $this->findById($newUserId);

                // EXECUTE UNILEVEL BONUS
                $this->executeUniLevel();
                $this->findById($newUserId);

                // EXECUTE SH BONUS
                $this->excecuteSHbonus($newUserId);

                //SEND VERIFICATION EMAIL =================================================================
                if ($_isDebug == false)
                {
                    $this->sendVerificaion($options->NickName,$newUserId,$options->Email);
                }
                return '200';
            }
            else
            {
                return '500';
            }

        }
        else{
            return $controllers->newAccount();
        }


    }

    function findById($userID){
        global $controllers;
        if ($controllers->findByUserID() == 'OK')
        {
            $controllers->findByUserID->stmt->execute(['accountcode' => cleanString($userID)]);
            $result = $controllers->findByUserID->stmt->fetch(PDO::FETCH_OBJ);
            $resultCount = $controllers->findByUserID->stmt->rowCount();

            if ($resultCount > 0)
            {
                $message_txt = 'Account found with ' . $resultCount . ' result(s)';
                $status = '200';

                //AUTO REFER AS THIS OBJECT
                $this->parentID = $result->upline_account_code;
                $this->userID = $result->account_code;
                $this->email = $result->email;
                $this->fullname = $result->fname . $result->mname . $result->lname;
                $this->userName = $result->username;
                $this->directs = new Directs($result->account_code);
                //$this->wallet = new wallet($result->account_code);
                $this->history = [];
                $this->dtCreated = $result->account_created;
                $this->dtLastLogon = $result->account_last_signin;
                $this->account_package = $result->account_package;
                $this->account_type = $result->account_type;
                $this->account_token = $result->account_token;
                $this->lastUpdate = $result->account_last_update;
                $this->lastUpdateDetail = $result->	account_last_change;
                $this->account_code = $result->account_code;

                return $this;
            }
            else
            {
                $message_txt = 'No results returned';
                $status = '500';
            }

        }
        else{
            $status = '301';
            $message_txt = $controllers->findByUserID();
        }

    }

    function findByUsername($username){
        global $controllers;
        if ($controllers->findByUserName() == 'OK')
        {
            $controllers->findByUserName->stmt->execute(['username' => cleanString($username)]);
            $result = $controllers->findByUserName->stmt->fetch(PDO::FETCH_OBJ);
            $resultCount = $controllers->findByUserName->stmt->rowCount();

            if ($resultCount > 0)
            {
                $message_txt = 'Account found with ' . $resultCount . ' result(s)';
                $status = '200';

                //AUTO REFER AS THIS OBJECT
                $this->parentID = $result->upline_account_code;
                $this->userID = $result->account_code;
                $this->email = $result->email;
                $this->fullname = $result->fname . $result->mname . $result->lname;
                $this->userName = $result->username;
                $this->directs = new Directs($result->account_code);
                //$this->wallet = new wallet($result->account_code);
                $this->history = [];
                $this->dtCreated = $result->account_created;
                $this->dtLastLogon = $result->account_last_signin;
                $this->account_package = $result->account_package;
                $this->lastUpdate = $result->account_last_update;
                $this->lastUpdateDetail = $result->	account_last_change;
                $this->account_code = $result->account_code;

                return $this;
            }
            else
            {
                $message_txt = 'No results returned';
                $status = '500';
            }

        }
        else{
            $status = '301';
            $message_txt = $controllers->findByUserName();
        }

    }

    function getUsersWithDirects($options){

        global $controllers;
        if ($controllers->getUsersWithDirects() == 'OK')
        {
            $data = [
             'directs_count' => $options->directs_count
             ];

            $controllers->getUsersWithDirects->stmt->execute($data);
            $result = $controllers->getUsersWithDirects->stmt->fetchAll(PDO::FETCH_OBJ);
            $resultCount = $controllers->getUsersWithDirects->stmt->rowCount();

            if ($resultCount > 0)
            {
                $message_txt = 'Accounts found with ' . $resultCount . ' result(s)';
                $status = '200';

                //RETURN RESULT OBJECT
                return $result;

            }
            else
            {
                return 'No results returned';
                $status = '500';
            }

        }
        else{
            $status = '301';
            return $controllers->getUsersWithDirects();
        }


    }

    function getAllUsers(){

        global $controllers;
        if ($controllers->getAllUsers() == 'OK')
        {
            $controllers->getAllUsers->stmt->execute();
            $result = $controllers->getAllUsers->stmt->fetchAll(PDO::FETCH_OBJ);
            $resultCount = $controllers->getAllUsers->stmt->rowCount();

            if ($resultCount > 0)
            {
                $message_txt = 'Account found with ' . $resultCount . ' result(s)';
                $status = '200';

                //RETURN RESULT OBJECT
                return $result;

            }
            else
            {
                return 'No results returned';
                $status = '500';
            }

        }
        else{
            $status = '301';
            return $controllers->getAllUsers();
        }


    }

    function editInfo($userID,$intent,$args){
        global $controllers;
        $sysLog = new system_logs;

        if ($intent == 'email')
        {
            if ($controllers->setAccountEmail() == 'OK')
            {
                $data = [
                 'userID' => $userID,
                 'account_email' => $args
                 ];

                if ($controllers->setAccountEmail->stmt->execute($data))
                {
                    $sysLog->createLog("Member Edit Info", "A member with username: " . $username . " has edited their email info", "USER_EDIT", "1", "NO", "OK", "","", "","");

                    return 'Manna Account Successfully Updated!';
                }
                else
                {
                    return '500';
                }

            }
            else{
                return $controllers->setAccountEmail();
            }
        }
        else  if ($intent == 'username')
        {
            if ($controllers->setAccountUsername() == 'OK')
            {
                $data = [
                 'userID' => $userID,
                 'account_username' => $args
                 ];

                if ($controllers->setAccountUsername->stmt->execute($data))
                {
                    $sysLog->createLog("Member Edit Info", "A member with username: " . $username . " has edited their username info", "USER_EDIT", "1", "NO", "OK", "","", "","");

                    return 'Manna Account Successfully Updated!';
                }
                else
                {
                    return '500';
                }

            }
            else{
                return $controllers->setAccountUsername();
            }
        }
        else  if ($intent == 'password')
        {
            if ($controllers->setAccountPassword() == 'OK')
            {
                $data = [
                 'userID' => $userID,
                 'account_psw' => md5($args)
                 ];

                if ($controllers->setAccountPassword->stmt->execute($data))
                {
                    $sysLog->createLog("Member Password Reset", "A member with userID: " . $userID . " has reset their password", "USER_RESET", "1", "NO", "OK", "","", "","");

                    return 'Manna Account Successfully Updated!';
                }
                else
                {
                    return '500';
                }

            }
            else{
                return $controllers->setAccountPassword();
            }
        }
        else if ($intent == 'package')
        {
            $package = new packages;
            $package->getPackageName($args);

            if ($controllers->setAccountPackage() == 'OK')
            {
                $data = [
                 'userID' => $userID,
                 'account_package' => $args
                 ];

                if ($controllers->setAccountPackage->stmt->execute($data))
                {
                    $sysLog->createLog("Member Package Upgrade", "A member with username: " . $username . " has upgraded their package to " . $package->name , "USER_UPGRADE", "1", "NO", "OK", "","", "","");

                    return 'Manna Account Successfully Updated!';
                }
                else
                {
                    return '500';
                }

            }
            else{
                return $controllers->setAccountPackage();
            }
        }


    }

    function checkDirectsPackages($userID){
        $referencePackageID = $this->account_package;

        $this->findById($userID);
        $loop_length = $this->directs->count;
        $directs = $this->directs->items;
        $z = 0;
        $upgraded = 0;

        while ($z < $loop_length)
        {

            if ($directs[$z]->account_package != $referencePackageID)
            {
                //return false;
            }
            else{$upgraded = $upgraded + 1;}

            if ($upgraded >= 5)
            {
                return true;
            }
            $z = $z + 1;

        }
        return false;
    }

    function executeBinaryPairing($options = null){
        global $controllers;
        $matrix = new matrix;
        $maps = new maps;
        $wallet = new wallet;
        $package = new packages;
        $upline_account_code = '';
        $user_pair = 0;
        $hasUpline = false;


        $this->findById($options->MatrixUpline);
        $downline_account_code = $this->userID;
        $upline_account_code = $this->parentID;

        //CHECK IF THERE IS UPLINE
        if ($this->findById($upline_account_code) != null)
        {
            $hasUpline = true;
        }
        else{
            //EXIT LOOP IF NO UPLINE
            $hasUpline = false;
        }

        while ($hasUpline == true)
        {
            $wallet->topUp($upline_account_code,1,$wallet->getWalletID('DL_COUNT'));
            $current_user =  $this->findById($upline_account_code);


            // CHECK NODE POSITION
            // TOP POSITION

            $current_node = $maps->FindByAccountCode($current_user);


            // ATTACH NODE TO MAP

            if ($current_node->maps_left_account_code == '')
            {
                $maps->AttachNodeToLeft($current_user,$downline_account_code);
            }
            else if ($current_node->maps_right_account_code == ''){
                $maps->AttachNodeToRight($current_user,$downline_account_code);
            }

            $current_node = $maps->FindByAccountCode($current_user);

            if ($current_node->maps_left_account_code == $downline_account_code)
            {
                // TOPUP NODE
                $node = new Node;
                $node->binaryPosition = '1';
                $node->account_code = $current_user->account_code;
                $node->binaryCount_left = 150;

                $matrix->NodeTopUp($node);

            }
            else if ($current_node->maps_right_account_code == $downline_account_code){
                // TOPUP NODE
                $node = new Node;
                $node->binaryPosition = '2';
                $node->account_code = $current_user->account_code;
                $node->binaryCount_right = 150;

                $matrix->NodeTopUp($node);
            }


            // CHECK FOR PAIRING
            if ($matrix->CheckForPairing($current_user))
            {
                $matrix->ConsumePair($current_user);

                // CHECK FOR 5TH PAIR

                if ($wallet->getWalletBalance($current_user->account_code,$wallet->getWalletID('PAIR_COUNTER')) > 4)
                {
                    if ($current_user->account_package == $package->getPackageID('SILVER'))
                    {
                        $user_pair = 500 * floatval($node->binaryCount_right);
                    }
                    else if ($current_user->account_package == $package->getPackageID('GOLD'))
                    {
                        $user_pair = 1000 * floatval($node->binaryCount_right);
                    }

                    $wallet->topUp($current_user->account_code,($user_pair),$wallet->getWalletID('5PRB'),true);
                    $wallet->setBalance($current_user->account_code,0,$wallet->getWalletID('PAIR_COUNTER'));
                }
                else{
                    $wallet->topUp($current_user->account_code, 150 ,$wallet->getWalletID('PAIR_COUNTER'));
                }

            }

            //CHECK IF THERE IS UPLINE
            if ($current_user->parentID != '')
            {
                //CONTINUE LOOP IF THERE IS UPLINE
                $upline_account_code = $current_user->parentID;
                $downline_account_code = $current_user->userID;
            }
            else{
                //EXIT LOOP IF NO UPLINE
                $hasUpline = false;
            }


        }





    }

    function executeUniLevel(){
        global $controllers;
        global $_date;
        $wallet = new wallet;
        $products = new products;
        $packages = new packages;

        $x = 0;
        $startLvl = 1;
        $maxLvl = 5;
        $tmpLog = '';
        $hasUpline = true;
        $initialUserId = $this->userID;
        $upline_account_code = $this->parentID;
        $packages->getPackageName($this->account_package);

        //REQUIRE 2 PRODUCTS PURCHASE

        while ($hasUpline == true and $startLvl <= $maxLvl)
        {
            $this->findById($upline_account_code);
            //$upline_account_code = $this->parentID;
            $tmpLog = $tmpLog . ' EXECUTE UNI LEVEL BONUS - ' . $x;
            $tmpLog = $tmpLog . ' USER ' . $this->userName;

            if ($products->checkRequirements($this))
            {

                if ($startLvl == 1)
                {
                    // ON LEVEL 1, GIVE 1.5% ON USER
                    $wallet->topUp($this->userID,(floatval($packages->value) * 0.015),$wallet->getWalletID('UL'),true);
                    $tmpLog = $tmpLog . ' - UL AT LEVEL ' . $startLvl . ', EARNING: ' . 25;
                }
                else if ($startLvl == 2)
                {
                    // ON LEVEL 2, GIVE 1% ON USER
                    $wallet->topUp($this->userID,(floatval($packages->value) * 0.01),$wallet->getWalletID('UL'),true);
                    $tmpLog = $tmpLog . ' - UL AT LEVEL ' . $startLvl . ', EARNING: ' . 20;
                }
                else if ($startLvl == 3)
                {
                    // ON LEVEL 3, GIVE 1% ON USER
                    $wallet->topUp($this->userID,(floatval($packages->value) * 0.01),$wallet->getWalletID('UL'),true);
                    $tmpLog = $tmpLog . ' - UL AT LEVEL ' . $startLvl . ', EARNING: ' . 20;
                }
                else if ($startLvl == 4)
                {
                    // ON LEVEL 4, GIVE 0.05% ON USER
                    $wallet->topUp($this->userID,(floatval($packages->value) * 0.005),$wallet->getWalletID('UL'),true);
                    $tmpLog = $tmpLog . ' - UL AT LEVEL ' . $startLvl . ', EARNING: ' . 20;
                }
                else if ($startLvl == 5)
                {
                    // ON LEVEL 5, GIVE 0.05% ON USER
                    $wallet->topUp($this->userID,(floatval($packages->value) * 0.005),$wallet->getWalletID('UL'),true);
                    $tmpLog = $tmpLog . ' - UL AT LEVEL ' . $startLvl . ', EARNING: ' . 20;
                }

                $startLvl++;

            }
            else {
                // IF REQUIREMENTS NOT MET, DO NOTHING..
            }

            //CHECK IF THERE IS UPLINE
            if ($this->parentID != '')
            {
                //CONTINUE LOOP IF THERE IS UPLINE
                $upline_account_code = $this->parentID;
            }
            else{
                //EXIT LOOP IF NO UPLINE
                $hasUpline = false;
            }

        }


        // RETURN TO INITIAL USER

        $this->findById($initialUserId);
    }

    function executeBonusPool($level){
        global $controllers;
        global $_date;
        $allAccounts = $this->getAllUsers();
        $wallet = new wallet;
        $package = new packages;
        $Bearnings = [40,80,100,150,300,500,1000,1500,2000,2500,5000,8000,10000,15000,20000,25000,30000,35000,40000,50000,75000,100000,200000,1000000];
        $Pearnings = [500,1500,2500,5000,7000,10000,15000,40000,50000,100000,200000,250000,400000,500000,1000000,2000000,3000000,5000000,10000000,15000000,20000000,25000000,150000000];
        $i = $level;

        $startEntry_count = 2;
        $required_users_counter = $wallet->getWalletBalance("ADMIN",$wallet->getWalletID('ADMIN_BP_' . $i));

        for ($c = 0; $c < $required_users_counter; $c++)
        {
            //$startEntry_count++;
        }

        // CHECK IF NO OF REQURED USER HAS BEEN MET
        $BP_USERS_COUNT = $wallet->getWalletBalance("ADMIN",$wallet->getWalletID('ADMIN_BP_USER_COUNT_' . $i));
        $BP_CURRENT_USER = $wallet->getWalletBalance("ADMIN",$wallet->getWalletID('ADMIN_BP_' . $i));
        $BP_CURRENT_USER_LEVEL = $wallet->getWalletBalance($allAccounts[$BP_CURRENT_USER]->account_code,$wallet->getWalletID('BP_COUNTER'));

        if ($BP_USERS_COUNT == $startEntry_count)
        {
            //CHECK PACKAGE
            if ($allAccounts[$BP_CURRENT_USER]->account_package >= $package->getPackageID('BASIC'))
            {
                // CHECK USER BP LEVEL

                if ($level < 23)
                {
                    $earning = $Bearnings[$i];
                    $wallet->topUp($allAccounts[$BP_CURRENT_USER]->account_code,$earning,$wallet->getWalletID('BP'));
                    $this->executeBonusPool(($BP_CURRENT_USER_LEVEL + 1));

                    $wallet->topUp("ADMIN", 1, $wallet->getWalletID('ADMIN_BP_' . $i));
                    $wallet->topUp($allAccounts[$BP_CURRENT_USER]->account_code, 1, $wallet->getWalletID('BP_COUNTER'));
                    $wallet->setBalance("ADMIN",'0',$wallet->getWalletID('ADMIN_BP_USER_COUNT_'. $i));
                }
            }

            //CHECK PACKAGE
            if ($allAccounts[$BP_CURRENT_USER]->account_package >= $package->getPackageID('PREMIUM'))
            {
                if ($level < 22)
                {
                    $earning = $Pearnings[$i];
                    $wallet->topUp($allAccounts[$BP_CURRENT_USER]->account_code,$earning,$wallet->getWalletID('BP'));

                    $wallet->topUp($allAccounts[$BP_CURRENT_USER]->account_code, 1, $wallet->getWalletID('BP_COUNTER'));
                    $wallet->topUp("ADMIN", 1, $wallet->getWalletID('ADMIN_BP_' . $i));
                    $wallet->setBalance("ADMIN",'0',$wallet->getWalletID('ADMIN_BP_USER_COUNT_'. $i));

                }



            }



        }
        else{
            // IF NOT, ADD USER TO COUNTER
            $wallet->topUp("ADMIN", 1, $wallet->getWalletID('ADMIN_BP_USER_COUNT_'. $i));

        }




    }

    function excecuteSHbonus($options){
        global $controllers;
        global $_date;
        $wallet = new wallet;
        $package = new packages;


        $encodedUser = $this->findById($options);
        $args = new stdClass;
        $args->directs_count = 3;

        $allUsers = $this->getUsersWithDirects($args);
        $length = count($allUsers) - 1;
        $x = 0;
        $tmpLog = '';


        while ($x < $length)
        {
            $upline_account_code = $allUsers[$x]->account_code;
            $this->findById($upline_account_code);

            $tmpLog = $tmpLog . ' EXECUTE SH BONUS - ' . $x;

            $tmpLog = $tmpLog . ' count ' . $this->userName;
            $AccountPackageAmount = $package->getPackageAmount($encodedUser->account_package);

            // CHECK FOR 3 DIRECTS
            if ($this->directs->count >= 3)
            {
                $wallet->topUp($upline_account_code,((floatval($AccountPackageAmount)*0.1) / count($allUsers)),$wallet->getWalletID('SH'),true);
                $tmpLog = $tmpLog . ' - SH AT 10%, PACKAGE @ ' . $AccountPackageAmount;

            }
            else{
                //DO NOTHING..
            }

            $x = $x + 1;

        }
        $tmpLog = $tmpLog . $x;
        //return $tmpLog;
    }

    function verifyAccount($userID){
        global $controllers;
        $sysLog = new system_logs;
        if ($controllers->setAccountToken() == 'OK')
        {
            $data = [
             'userID' => $userID,
             'account_token' => generateRandomString(64)
             ];

            if ($controllers->setAccountToken->stmt->execute($data))
            {
                $sysLog->createLog("Member Verification", "A member with username: " . $username . " successfully verified", "USER_VERIFY", "1", "NO", "OK", "","", "","");

                return 'Manna Account Successfully Verified!';
            }
            else
            {
                return '500';
            }

        }
        else{
            return $controllers->setAccountToken();
        }


    }

    function sendVerificaion($nickName,$userID,$data_email){
        $email_stat = '';

        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->SMTPDebug = 0;
        $mail->Host = 'smtp.hostinger.ph';
        $mail->Port = 587;
        $mail->SMTPAuth = true;
        $mail->Username = 'info@dherbs.com';
        $mail->Password = 'admin@dherbs';
        $mail->setFrom('info@dherbs.dherbs', 'dherbs');
        //$mail->addReplyTo('reply-box@hostinger-tutorials.com', 'Your Name');
        $mail->addAddress($data_email, $nickName);
        $mail->Subject = 'Registration Successful!';
        $mail->msgHTML('
<html>
  <head>
    <meta name="viewport" content="width=device-width" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>EMPEROR COIN</title>
    <style>
      /* -------------------------------------
          GLOBAL RESETS
      ------------------------------------- */
      img {
        border: none;
        -ms-interpolation-mode: bicubic;
        max-width: 100%; }
      body {
        background-color: #f6f6f6;
        font-family: sans-serif;
        -webkit-font-smoothing: antialiased;
        font-size: 14px;
        line-height: 1.4;
        margin: 0;
        padding: 0;
        -ms-text-size-adjust: 100%;
        -webkit-text-size-adjust: 100%; }
      table {
        border-collapse: separate;
        mso-table-lspace: 0pt;
        mso-table-rspace: 0pt;
        width: 100%; }
        table td {
          font-family: sans-serif;
          font-size: 14px;
          vertical-align: top; }
      /* -------------------------------------
          BODY & CONTAINER
      ------------------------------------- */
      .body {
        background-color: #f6f6f6;
        width: 100%; }
      /* Set a max-width, and make it display as block so it will automatically stretch to that width, but will also shrink down on a phone or something */
      .container {
        display: block;
        Margin: 0 auto !important;
        /* makes it centered */
        max-width: 580px;
        padding: 10px;
        width: 580px; }
      /* This should also be a block element, so that it will fill 100% of the .container */
      .content {
        box-sizing: border-box;
        display: block;
        Margin: 0 auto;
        max-width: 580px;
        padding: 10px; }
      /* -------------------------------------
          HEADER, FOOTER, MAIN
      ------------------------------------- */
      .main {
        background: #fff;
        border-radius: 3px;
        width: 100%; }
      .wrapper {
        box-sizing: border-box;
        padding: 20px; }
      .footer {
        clear: both;
        padding-top: 10px;
        text-align: center;
        width: 100%; }
        .footer td,
        .footer p,
        .footer span,
        .footer a {
          color: #999999;
          font-size: 12px;
          text-align: center; }
      /* -------------------------------------
          TYPOGRAPHY
      ------------------------------------- */
      h1,
      h2,
      h3,
      h4 {
        color: #000000;
        font-family: sans-serif;
        font-weight: 400;
        line-height: 1.4;
        margin: 0;
        Margin-bottom: 30px; }
      h1 {
        font-size: 35px;
        font-weight: 300;
        text-align: center;
        text-transform: capitalize; }
      p,
      ul,
      ol {
        font-family: sans-serif;
        font-size: 14px;
        font-weight: normal;
        margin: 0;
        Margin-bottom: 15px; }
        p li,
        ul li,
        ol li {
          list-style-position: inside;
          margin-left: 5px; }
      a {
        color: #3498db;
        text-decoration: underline; }
      /* -------------------------------------
          BUTTONS
      ------------------------------------- */
      .btn {
        box-sizing: border-box;
        width: 100%; }
        .btn > tbody > tr > td {
          padding-bottom: 15px; }
        .btn table {
          width: auto; }
        .btn table td {
          background-color: #ffffff;
          border-radius: 5px;
          text-align: center; }
        .btn a {
          background-color: #ffffff;
          border: solid 1px #3498db;
          border-radius: 5px;
          box-sizing: border-box;
          color: #3498db;
          cursor: pointer;
          display: inline-block;
          font-size: 14px;
          font-weight: bold;
          margin: 0;
          padding: 12px 25px;
          text-decoration: none;
          text-transform: capitalize; }
      .btn-primary table td {
        background-color: #3498db; }
      .btn-primary a {
        background-color: #3498db;
        border-color: #3498db;
        color: #ffffff; }
      /* -------------------------------------
          OTHER STYLES THAT MIGHT BE USEFUL
      ------------------------------------- */
      .last {
        margin-bottom: 0; }
      .first {
        margin-top: 0; }
      .align-center {
        text-align: center; }
      .align-right {
        text-align: right; }
      .align-left {
        text-align: left; }
      .clear {
        clear: both; }
      .mt0 {
        margin-top: 0; }
      .mb0 {
        margin-bottom: 0; }
      .preheader {
        color: transparent;
        display: none;
        height: 0;
        max-height: 0;
        max-width: 0;
        opacity: 0;
        overflow: hidden;
        mso-hide: all;
        visibility: hidden;
        width: 0; }
      .powered-by a {
        text-decoration: none; }
      hr {
        border: 0;
        border-bottom: 1px solid #f6f6f6;
        Margin: 20px 0; }
      /* -------------------------------------
          RESPONSIVE AND MOBILE FRIENDLY STYLES
      ------------------------------------- */
      @media only screen and (max-width: 620px) {
        table[class=body] h1 {
          font-size: 28px !important;
          margin-bottom: 10px !important; }
        table[class=body] p,
        table[class=body] ul,
        table[class=body] ol,
        table[class=body] td,
        table[class=body] span,
        table[class=body] a {
          font-size: 16px !important; }
        table[class=body] .wrapper,
         table[class=body] .article {
           padding: 10px !important; }
         table[class=body] .content {
           padding: 0 !important; }
         table[class=body] .container {
           padding: 0 !important;
           width: 100% !important; }
         table[class=body] .main {
           border-left-width: 0 !important;
           border-radius: 0 !important;
           border-right-width: 0 !important; }
         table[class=body] .btn table {
           width: 100% !important; }
         table[class=body] .btn a {
           width: 100% !important; }
         table[class=body] .img-responsive {
           height: auto !important;
           max-width: 100% !important;
           width: auto !important; }}
      /* -------------------------------------
          PRESERVE THESE STYLES IN THE HEAD
      ------------------------------------- */
      @media all {
        .ExternalClass {
          width: 100%; }
        .ExternalClass,
        .ExternalClass p,
        .ExternalClass span,
        .ExternalClass font,
        .ExternalClass td,
        .ExternalClass div {
          line-height: 100%; }
        .apple-link a {
          color: inherit !important;
          font-family: inherit !important;
          font-size: inherit !important;
          font-weight: inherit !important;
          line-height: inherit !important;
          text-decoration: none !important; }
        .btn-primary table td:hover {
          background-color: #34495e !important; }
        .btn-primary a:hover {
          background-color: #34495e !important;
          border-color: #34495e !important; } }
    </style>
  </head>
  <body class="">
    <table border="0" cellpadding="0" cellspacing="0" class="body">
      <tr>
        <td>&nbsp;</td>
        <td class="container">
          <div class="content">

            <!-- START CENTERED WHITE CONTAINER -->
            <h2></h2>
            <table class="main">

              <!-- START MAIN CONTENT AREA -->
              <tr>
                <td class="wrapper">
                  <table border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td>
                        <h2>Welcome Manna!</h2>
                        <p>You road to financial freedom is now here!</p>
                        <br/>
                        <p>Please Verify Your email by clicking the link below:</p>
  <br/>
 <a href="https://manna.live/api/interface/verify_account?account_code=' . $userID . '">CLICK HERE TO VERIFY ACCOUNT</a>

                        <table border="0" cellpadding="0" cellspacing="0" class="btn btn-primary">
                          <tbody>
                            <tr>
                              <td align="left">
                                <table border="0" cellpadding="0" cellspacing="0">
                                  <tbody>
                                    <tr>

                                    </tr>
                                  </tbody>
                                </table>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                        <p> This is a computer-generated email, DO NOT REPLY.</p>
                        <p>  </p>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>

              <!-- END MAIN CONTENT AREA -->
              </table>

            <!-- START FOOTER -->
            <div class="footer">
              <table border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td class="content-block">

                  </td>
                </tr>
                <tr>
                  <td class="content-block powered-by">
                    Powered by <a href="#">Manna</a>.
                  </td>
                </tr>
              </table>
            </div>
            <!-- END FOOTER -->

          <!-- END CENTERED WHITE CONTAINER -->
          </div>
        </td>
        <td>&nbsp;</td>
      </tr>
    </table>
  </body>
</html>');
        //$mail->msgHTML(file_get_contents('message.html'), __DIR__);
        //$mail->AltBody = 'This is a plain text message body';
        //$mail->addAttachment('test.txt');

        if (!$mail->send()) {
            $email_stat = 'Mailer Error: ' . $mail->ErrorInfo;
        } else {
            $email_stat = '200';
        }
        return $email_stat;

    }

    function resetPassword($userID,$data_email){
        $email_stat = '';
        $newPswd = generateRandomString(8);
        $sysLog = new system_logs;

        $mail = new PHPMailer;
        $mail->isSMTP();
        $mail->SMTPDebug = 0;
        $mail->Host = 'smtp.hostinger.ph';
        $mail->Port = 587;
        $mail->SMTPAuth = true;
        $mail->Username = 'info@manna.live';
        $mail->Password = 'admin@manna';
        $mail->setFrom('info@manna.live', 'Manna');
        //$mail->addReplyTo('reply-box@hostinger-tutorials.com', 'Your Name');
        $mail->addAddress($data_email, "Password reset");
        $mail->Subject = 'Password Reset';
        $mail->msgHTML('
<html>
  <head>
    <meta name="viewport" content="width=device-width" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title>EMPEROR COIN</title>
    <style>
      /* -------------------------------------
          GLOBAL RESETS
      ------------------------------------- */
      img {
        border: none;
        -ms-interpolation-mode: bicubic;
        max-width: 100%; }
      body {
        background-color: #f6f6f6;
        font-family: sans-serif;
        -webkit-font-smoothing: antialiased;
        font-size: 14px;
        line-height: 1.4;
        margin: 0;
        padding: 0;
        -ms-text-size-adjust: 100%;
        -webkit-text-size-adjust: 100%; }
      table {
        border-collapse: separate;
        mso-table-lspace: 0pt;
        mso-table-rspace: 0pt;
        width: 100%; }
        table td {
          font-family: sans-serif;
          font-size: 14px;
          vertical-align: top; }
      /* -------------------------------------
          BODY & CONTAINER
      ------------------------------------- */
      .body {
        background-color: #f6f6f6;
        width: 100%; }
      /* Set a max-width, and make it display as block so it will automatically stretch to that width, but will also shrink down on a phone or something */
      .container {
        display: block;
        Margin: 0 auto !important;
        /* makes it centered */
        max-width: 580px;
        padding: 10px;
        width: 580px; }
      /* This should also be a block element, so that it will fill 100% of the .container */
      .content {
        box-sizing: border-box;
        display: block;
        Margin: 0 auto;
        max-width: 580px;
        padding: 10px; }
      /* -------------------------------------
          HEADER, FOOTER, MAIN
      ------------------------------------- */
      .main {
        background: #fff;
        border-radius: 3px;
        width: 100%; }
      .wrapper {
        box-sizing: border-box;
        padding: 20px; }
      .footer {
        clear: both;
        padding-top: 10px;
        text-align: center;
        width: 100%; }
        .footer td,
        .footer p,
        .footer span,
        .footer a {
          color: #999999;
          font-size: 12px;
          text-align: center; }
      /* -------------------------------------
          TYPOGRAPHY
      ------------------------------------- */
      h1,
      h2,
      h3,
      h4 {
        color: #000000;
        font-family: sans-serif;
        font-weight: 400;
        line-height: 1.4;
        margin: 0;
        Margin-bottom: 30px; }
      h1 {
        font-size: 35px;
        font-weight: 300;
        text-align: center;
        text-transform: capitalize; }
      p,
      ul,
      ol {
        font-family: sans-serif;
        font-size: 14px;
        font-weight: normal;
        margin: 0;
        Margin-bottom: 15px; }
        p li,
        ul li,
        ol li {
          list-style-position: inside;
          margin-left: 5px; }
      a {
        color: #3498db;
        text-decoration: underline; }
      /* -------------------------------------
          BUTTONS
      ------------------------------------- */
      .btn {
        box-sizing: border-box;
        width: 100%; }
        .btn > tbody > tr > td {
          padding-bottom: 15px; }
        .btn table {
          width: auto; }
        .btn table td {
          background-color: #ffffff;
          border-radius: 5px;
          text-align: center; }
        .btn a {
          background-color: #ffffff;
          border: solid 1px #3498db;
          border-radius: 5px;
          box-sizing: border-box;
          color: #3498db;
          cursor: pointer;
          display: inline-block;
          font-size: 14px;
          font-weight: bold;
          margin: 0;
          padding: 12px 25px;
          text-decoration: none;
          text-transform: capitalize; }
      .btn-primary table td {
        background-color: #3498db; }
      .btn-primary a {
        background-color: #3498db;
        border-color: #3498db;
        color: #ffffff; }
      /* -------------------------------------
          OTHER STYLES THAT MIGHT BE USEFUL
      ------------------------------------- */
      .last {
        margin-bottom: 0; }
      .first {
        margin-top: 0; }
      .align-center {
        text-align: center; }
      .align-right {
        text-align: right; }
      .align-left {
        text-align: left; }
      .clear {
        clear: both; }
      .mt0 {
        margin-top: 0; }
      .mb0 {
        margin-bottom: 0; }
      .preheader {
        color: transparent;
        display: none;
        height: 0;
        max-height: 0;
        max-width: 0;
        opacity: 0;
        overflow: hidden;
        mso-hide: all;
        visibility: hidden;
        width: 0; }
      .powered-by a {
        text-decoration: none; }
      hr {
        border: 0;
        border-bottom: 1px solid #f6f6f6;
        Margin: 20px 0; }
      /* -------------------------------------
          RESPONSIVE AND MOBILE FRIENDLY STYLES
      ------------------------------------- */
      @media only screen and (max-width: 620px) {
        table[class=body] h1 {
          font-size: 28px !important;
          margin-bottom: 10px !important; }
        table[class=body] p,
        table[class=body] ul,
        table[class=body] ol,
        table[class=body] td,
        table[class=body] span,
        table[class=body] a {
          font-size: 16px !important; }
        table[class=body] .wrapper,
         table[class=body] .article {
           padding: 10px !important; }
         table[class=body] .content {
           padding: 0 !important; }
         table[class=body] .container {
           padding: 0 !important;
           width: 100% !important; }
         table[class=body] .main {
           border-left-width: 0 !important;
           border-radius: 0 !important;
           border-right-width: 0 !important; }
         table[class=body] .btn table {
           width: 100% !important; }
         table[class=body] .btn a {
           width: 100% !important; }
         table[class=body] .img-responsive {
           height: auto !important;
           max-width: 100% !important;
           width: auto !important; }}
      /* -------------------------------------
          PRESERVE THESE STYLES IN THE HEAD
      ------------------------------------- */
      @media all {
        .ExternalClass {
          width: 100%; }
        .ExternalClass,
        .ExternalClass p,
        .ExternalClass span,
        .ExternalClass font,
        .ExternalClass td,
        .ExternalClass div {
          line-height: 100%; }
        .apple-link a {
          color: inherit !important;
          font-family: inherit !important;
          font-size: inherit !important;
          font-weight: inherit !important;
          line-height: inherit !important;
          text-decoration: none !important; }
        .btn-primary table td:hover {
          background-color: #34495e !important; }
        .btn-primary a:hover {
          background-color: #34495e !important;
          border-color: #34495e !important; } }
    </style>
  </head>
  <body class="">
    <table border="0" cellpadding="0" cellspacing="0" class="body">
      <tr>
        <td>&nbsp;</td>
        <td class="container">
          <div class="content">

            <!-- START CENTERED WHITE CONTAINER -->
            <h2></h2>
            <table class="main">

              <!-- START MAIN CONTENT AREA -->
              <tr>
                <td class="wrapper">
                  <table border="0" cellpadding="0" cellspacing="0">
                    <tr>
                      <td>
                        <h2>Manna Account Password Reset</h2>
                        <p>You requested for new password. Below is your new password:</p>
                        <br/>
                        <p>Your new passowrd is: <b>' . $newPswd . '</b></p>

                        <table border="0" cellpadding="0" cellspacing="0" class="btn btn-primary">
                          <tbody>
                            <tr>
                              <td align="left">
                                <table border="0" cellpadding="0" cellspacing="0">
                                  <tbody>
                                    <tr>

                                    </tr>
                                  </tbody>
                                </table>
                              </td>
                            </tr>
                          </tbody>
                        </table>
                        <p> This is a computer-generated email, DO NOT REPLY.</p>
                        <p>  </p>
                      </td>
                    </tr>
                  </table>
                </td>
              </tr>

              <!-- END MAIN CONTENT AREA -->
              </table>

            <!-- START FOOTER -->
            <div class="footer">
              <table border="0" cellpadding="0" cellspacing="0">
                <tr>
                  <td class="content-block">

                  </td>
                </tr>
                <tr>
                  <td class="content-block powered-by">
                    Powered by <a href="#">Manna</a>.
                  </td>
                </tr>
              </table>
            </div>
            <!-- END FOOTER -->

          <!-- END CENTERED WHITE CONTAINER -->
          </div>
        </td>
        <td>&nbsp;</td>
      </tr>
    </table>
  </body>
</html>');
        //$mail->msgHTML(file_get_contents('message.html'), __DIR__);
        //$mail->AltBody = 'This is a plain text message body';
        //$mail->addAttachment('test.txt');

        if (!$mail->send()) {
            $email_stat = 'Mailer Error: ' . $mail->ErrorInfo;
        } else {

            global $controllers;

            if ($controllers->setAccountPassword() == 'OK')
            {
                $data = [
                 'userID' => $userID,
                 'account_psw' => md5($newPswd)
                 ];

                if ($controllers->setAccountPassword->stmt->execute($data))
                {
                    $sysLog->createLog("Member Password Reset", "A member with userID: " . $userID . " has reset their password", "USER_RESET", "1", "NO", "OK", "","", "","");

                    // return 'Manna Account Successfully Verified!';
                }
                else
                {
                    //return '500';
                }

            }
            else{
                return $controllers->setAccountPassword();
            }

            $email_stat = '200';
        }
        return $email_stat;

    }

    function upgrade($ticketCode){
        global $controllers;

        $getTicket = new tickets($ticketCode);
        $accountPackage = 0;
        $package = new packages;


        if ($getTicket->count == 0 Or $getTicket->ticket_status == 2 Or $getTicket->ticket_status == 3)
        {
            return '500';
        }
        else{
            $getTicket->consume($this->userID);
            $accountPackage = $getTicket->ticket_type;
        }

        $package->getPackageName($accountPackage);

        if ($controllers->setAccountPackage() == 'OK')
        {
            $data = [
             'userID' => $this->userID,
             'account_package' => $accountPackage
             ];

            if ($controllers->setAccountPackage->stmt->execute($data))
            {
                $sysLog->createLog("Member Package Upgrade", "A member with username: " . $username . " has upgraded their package to " . $package->name , "USER_UPGRADE", "1", "NO", "OK", "","", "","");

                //return 'Manna Account Successfully Updated!';
                return '200';
            }
            else
            {
                return '500';
            }

        }
        else{
            return $controllers->setAccountPackage();
        }

    }

    function requestPayout($mode,$amount,$desc){
        $sysLog = new system_logs;
        return  $sysLog->createLog("Member Payout", "A member with username: " . $this->userName . " has requested payout to " . $mode . " (" . $desc . ") with total amount of " . $amount . " PHP", "USER_PAYOUT", "2", "NO", "WAIT", "", $amount,"", "", $this->userName);
    }

    function approvePayout($logID,$username){
        $sysLog = new system_logs;
        $sysLog->findById($logID);
        $sysLog->createLog("Member Cashout Approves", "A member with username: " . $username . " has been approved for their cashout." , "USER_CASHOUT", "1", "NO", "OK", "","", "","");

        return  $sysLog->updateStatus("OK");
    }

    function updateShDalay(){
        global $controllers;
        global $_date;
        $sysLog = new system_logs;

        if ($controllers->setAccountShDelay() == 'OK')
        {
            $data = [
             'userID' => $this->userID,
             'account_last_update' => $_date
             ];

            if ($controllers->setAccountShDelay->stmt->execute($data))
            {
                $sysLog->createLog("Member SH Bonus", "A member with username: " . $this->userName . " has already started their 8 days SH Bonus " , "USER_INFO", "1", "NO", "OK", "","", "","");

                //return 'Manna Account Successfully Updated!';
                return '200';
            }
            else
            {
                return '500';
            }

        }
        else{
            return $controllers->setAccountShDelay();
        }

    }


}

class user{
    function __construct()
    {
        $this->FirstName;
        $this->MiddleName;
        $this->LastName;
        $this->NickName;
        $this->Email;
        $this->Phone;
        $this->Gender;
        $this->UplineAccountCode;
        $this->AccountType;
        $this->AccountPackage;
        $this->TicketCode;
        $this->Password;
        $this->UserName;
        $this->Position;
        $this->MatrixUpline;
        $this->account_code;
    }
}

?>