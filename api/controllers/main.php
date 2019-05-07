<?php
// ELON FRAMEWORK
// A LIGHTWEIGHT, FAST AND SECURE ALTERNATIVE PHP FRAMEWORK FOR DEVELOPING SERVER SIDE APPLICATIONS
// MIC-BASED FRAMEWORK (MODEL-INTERFACE-CONTROLLER)

// DEVELOPED BY XEON ERALDO
// VERSION 0.3.1, JANUARY 2019

//===================================================================================================

// LOAD ALL IMPORTS AND MODULES
include('sub_auth.php');
include('sub_new_account.php');
include('sub_find_by_userid.php');
include('sub_new_wallets.php');
include('sub_find_by_walletname.php');
include('sub_wallet_topup.php');
include('sub_wallet_balance.php');
include('sub_wallet_set_balance.php');
include('sub_find_by_username.php');
include('sub_get_all_users.php');
include('sub_set_account_token.php');
include('sub_set_account_password.php');
include('sub_set_account_email.php');
include('sub_set_account_username.php');
include('sub_new_ticket.php');
include('sub_get_all_ticket.php');
include('sub_find_by_ticketcode.php');
include('sub_set_ticket_consume.php');
include('sub_find_by_logid.php');
include('sub_new_log.php');
include('sub_get_all_logs.php');
include('sub_set_log_status.php');
include('sub_new_card.php');
include('sub_find_by_card_userid.php');
include('sub_find_by_card_uid.php');
include('sub_get_all_cards.php');

class controllers{

    function __construct($pdo){
        // CONTROLLER SETTINGS - ENABLE OR DISABLE CONTROLLER

        // AUTH CONTROLLERS
        $this->auth = new sub_controller_auth("1");

        // FIND CONTROLLERS
        $this->findByUserID = new sub_controller_find_by_userid("1");
        $this->findByUserName = new sub_controller_find_by_username("1");
        $this->findByTicketCode = new sub_controller_find_by_ticketcode("1");
        $this->findByLogId = new sub_controller_find_by_logid("1");
        $this->findByCardUserID = new sub_controller_find_by_card_userid("1");
        $this->findByCardUID = new sub_controller_find_by_card_uid("1");

        // CREATE CONTROLLERS
        $this->newAccount = new sub_controller_createAccount("1");
        $this->newWallets = new sub_controller_createWallets("1");
        $this->newTicket = new sub_controller_createTicket("1");
        $this->newSystemLog = new sub_controller_createSystemLog("1");
        $this->newCard = new sub_controller_createCard("1");

        // GET CONTROLLERS
        $this->getWalletID = new sub_controller_find_by_walletName("1");
        $this->getWalletBalance = new sub_controller_wallet_balance("1");
        $this->getAllUsers = new sub_controller_get_all_users("1");
        $this->getAllTicket = new sub_controller_get_all_ticket("1");
        $this->getAllLogs = new sub_controller_get_all_logs("1");
        $this->getAllCards = new sub_controller_get_all_cards("1");

        // SET CONTROLLERS
        $this->setWalletBalance = new sub_controller_wallet_setBalance("1");
        $this->setAccountToken = new sub_controller_set_account_token("1");
        $this->setAccountPassword = new sub_controller_set_account_password("1");
        $this->setAccountEmail = new sub_controller_set_account_email("1");
        $this->setAccountUsername = new sub_controller_set_account_username("1");
        $this->setTicketConsume = new sub_controller_set_ticket_consume("1");
        $this->setLogStatus = new sub_controller_set_log_status("1");

        $this->walletTopUp = new sub_controller_wallet_topUp("1");

        //$controllers = $this;
    }

    // CONTROLLER WRAPPERS FUNCTION
    function auth(){
       return $this->auth->providers_query();
    }
    function newAccount(){
        return $this->newAccount->providers_query();
    }
    function findByUserID(){
        return $this->findByUserID->providers_query();
    }
    function getDirects(){
        return $this->getDirects->providers_query();
    }
    function newWallets(){
        return $this->newWallets->providers_query();
    }
    function getWalletID(){
        return $this->getWalletID->providers_query();
    }
    function walletTopUp(){
        return $this->walletTopUp->providers_query();
    }
    function getWalletBalance(){
        return $this->getWalletBalance->providers_query();
    }
    function setWalletBalance(){
        return $this->setWalletBalance->providers_query();
    }
    function findByUserName(){
        return $this->findByUserName->providers_query();
    }
    function getAllUsers(){
        return $this->getAllUsers->providers_query();
    }
    function setAccountToken(){
        return $this->setAccountToken->providers_query();
    }
    function setAccountPassword(){
        return $this->setAccountPassword->providers_query();
    }
    function setAccountEmail(){
        return $this->setAccountEmail->providers_query();
    }
    function setAccountUsername(){
        return $this->setAccountUsername->providers_query();
    }
    function newTicket(){
        return $this->newTicket->providers_query();
    }
    function getAllTicket(){
        return $this->getAllTicket->providers_query();
    }
    function findByTicketCode(){
        return $this->findByTicketCode->providers_query();
    }
    function setTicketConsume(){
        return $this->setTicketConsume->providers_query();
    }
    function findByLogId(){
        return $this->findByLogId->providers_query();
    }
    function newSystemLog(){
        return $this->newSystemLog->providers_query();
    }
    function getAllLogs(){
        return $this->getAllLogs->providers_query();
    }
    function getPayoutLogs(){
        return $this->getPayoutLogs->providers_query();
    }
    function setLogStatus(){
        return $this->setLogStatus->providers_query();
    }
    function newCard(){
        return $this->newCard->providers_query();
    }
    function findByCardUserID(){
        return $this->findByCardUserID->providers_query();
    }
    function findByCardUID(){
        return $this->findByCardUID->providers_query();
    }
    function getAllCards(){
        return $this->getAllCards->providers_query();
    }


}


?>