<?php
// ELON FRAMEWORK
// A LIGHTWEIGHT, FAST AND SECURE ALTERNATIVE PHP FRAMEWORK FOR DEVELOPING SERVER SIDE APPLICATIONS
// MIC-BASED FRAMEWORK (MODEL-INTERFACE-CONTROLLER)

// DEVELOPED BY XEON ERALDO
// VERSION 0.3.1, JANUARY 2019

//===================================================================================================

// LOAD ALL IMPORTS AND MODULES
include('sub_auth.php');
include('sub_auth_bypass.php');
include('sub_new_account.php');
include('sub_find_by_userid.php');
include('sub_get_directs.php');
include('sub_new_wallets.php');
include('sub_find_by_walletname.php');
include('sub_wallet_topup.php');
include('sub_new_packages.php');
include('sub_find_by_packagename.php');
include('sub_wallet_balance.php');
include('sub_package_amount.php');
include('sub_wallet_set_balance.php');
include('sub_find_by_packageid.php');
include('sub_find_by_username.php');
include('sub_get_all_users.php');
include('sub_set_account_token.php');
include('sub_set_account_package.php');
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
include('sub_get_payout_logs.php');
include('sub_set_log_status.php');
include('sub_set_account_sh_dalay.php');
include('sub_new_product.php');
include('sub_find_by_product_id.php');
include('sub_get_all_products.php');
include('sub_new_product_tx.php');
include('sub_set_product_balance.php');
include('sub_set_product_balance_topup.php');
include('sub_new_binary_user.php');
include('sub_new_maps_binary_node.php');
include('sub_find_by_matrix_accountcode.php');
include('sub_set_maps_attach_left.php');
include('sub_set_maps_attach_right.php');
include('sub_matrix_binary_topup_left.php');
include('sub_matrix_binary_topup_right.php');
include('sub_matrix_binary_set_left.php');
include('sub_matrix_binary_set_right.php');
include('sub_find_by_maps_userid.php');
include('sub_new_blockchain_payment.php');

class controllers{

    function __construct($pdo){
        // CONTROLLER SETTINGS - ENABLE OR DISABLE CONTROLLER
        $this->auth = new sub_controller_auth("1");
        $this->authBypass = new sub_controller_auth_bypass("1");
        $this->newAccount = new sub_controller_createAccount("1");
        $this->findByUserID = new sub_controller_find_by_userid("1");
        $this->getDirects = new sub_controller_get_directs("1");
        $this->newWallets = new sub_controller_createWallets("1");
        $this->getWalletID = new sub_controller_find_by_walletName("1");
        $this->walletTopUp = new sub_controller_wallet_topUp("1");
        $this->newPackage = new sub_controller_createPackages("1");
        $this->getPackageID = new sub_controller_find_by_packageName("1");
        $this->getWalletBalance = new sub_controller_wallet_balance("1");
        $this->getPackageAmount = new sub_controller_package_amount("1");
        $this->setWalletBalance = new sub_controller_wallet_setBalance("1");
        $this->getPackageName = new sub_controller_find_by_packageId("1");
        $this->findByUserName = new sub_controller_find_by_username("1");
        $this->getAllUsers = new sub_controller_get_all_users("1");
        $this->setAccountToken = new sub_controller_set_account_token("1");
        $this->setAccountPassword = new sub_controller_set_account_password("1");
        $this->setAccountEmail = new sub_controller_set_account_email("1");
        $this->setAccountUsername = new sub_controller_set_account_username("1");
        $this->setAccountPackage = new sub_controller_set_account_package("1");
        $this->newTicket = new sub_controller_createTicket("1");
        $this->getAllTicket = new sub_controller_get_all_ticket("1");
        $this->findByTicketCode = new sub_controller_find_by_ticketcode("1");
        $this->setTicketConsume = new sub_controller_set_ticket_consume("1");
        $this->findByLogId = new sub_controller_find_by_logid("1");
        $this->newSystemLog = new sub_controller_createSystemLog("1");
        $this->getAllLogs = new sub_controller_get_all_logs("1");
        $this->getPayoutLogs = new sub_controller_get_payout_logs("1");
        $this->setLogStatus = new sub_controller_set_log_status("1");
        $this->setAccountShDelay = new sub_controller_set_account_sh_delay("1");
        $this->newProduct = new sub_controller_createProduct("1");
        $this->findByProductId = new sub_controller_find_by_productId("1");
        $this->getAllProducts = new sub_controller_get_all_products("1");
        $this->newProductTx = new sub_controller_createProductTx("1");
        $this->set_product_balance = new sub_controller_products_setBalance("1");
        $this->productTopUp = new sub_controller_products_setBalance_topup("1");
        $this->newBinaryUser = new sub_controller_createBinaryUser("1");
        $this->newMapsBinaryNode = new sub_controller_createMapsBinaryNode("1");
        $this->findByMatrixUserId = new sub_controller_find_by_matrix_accountcode("1");
        $this->setMapsAttachRight = new sub_controller_set_maps_attach_right("1");
        $this->setMapsAttachLeft = new sub_controller_set_maps_attach_left("1");
        $this->matrixBinaryTopUpLeft = new sub_controller_matrix_binary_topUp_left("1");
        $this->matrixBinaryTopUpRight = new sub_controller_matrix_binary_topUp_right("1");
        $this->matrixSetLeft = new sub_controller_matrix_set_left("1");
        $this->matrixSetRight = new sub_controller_matrix_set_right("1");
        $this->findByMapsUserId = new sub_controller_find_by_maps_userid("1");
        $this->newBlockchainPayment = new sub_controller_new_blockchain_payment("1");

        $controllers = $this;
    }

    function auth(){
       return $this->auth->providers_query();
    }
    function authBypass(){
        return $this->authBypass->providers_query();
    }
    public function newAccount(){
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
    function newPackage(){
        return $this->newPackage->providers_query();
    }
    function getPackageID(){
        return $this->getPackageID->providers_query();
    }
    function getWalletBalance(){
        return $this->getWalletBalance->providers_query();
    }
    function getPackageAmount(){
        return $this->getPackageAmount->providers_query();
    }
    function setWalletBalance(){
        return $this->setWalletBalance->providers_query();
    }
    function getPackageName(){
        return $this->getPackageName->providers_query();
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
    function setAccountPackage(){
        return $this->setAccountPackage->providers_query();
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
    function setAccountShDelay(){
        return $this->setAccountShDelay->providers_query();
    }
    function newProduct(){
        return $this->newProduct->providers_query();
    }
    function findByProductId(){
        return $this->findByProductId->providers_query();
    }
    function getAllProducts(){
        return $this->getAllProducts->providers_query();
    }
    function newProductTx(){
        return $this->newProductTx->providers_query();
    }
    function productTopUp(){
        return $this->productTopUp->providers_query();
    }
    function set_product_balance(){
        return $this->set_product_balance->providers_query();
    }
    function newBinaryUser(){
        return $this->newBinaryUser->providers_query();
    }
    function newMapsBinaryNode(){
        return $this->newMapsBinaryNode->providers_query();
    }
    function findByMatrixUserId(){
        return $this->findByMatrixUserId->providers_query();
    }
    function setMapsAttachRight(){
        return $this->setMapsAttachRight->providers_query();
    }
    function setMapsAttachLeft(){
        return $this->setMapsAttachLeft->providers_query();
    }
    function matrixBinaryTopUpLeft(){
        return $this->matrixBinaryTopUpLeft->providers_query();
    }
    function matrixBinaryTopUpRight(){
        return $this->matrixBinaryTopUpRight->providers_query();
    }
    function matrixSetLeft(){
        return $this->matrixSetLeft->providers_query();
    }
    function matrixSetRight(){
        return $this->matrixSetRight->providers_query();
    }
    function findByMapsUserId(){
        return $this->findByMapsUserId->providers_query();
    }

    function newBlockchainPayment(){
        return $this->newBlockchainPayment->providers_query();
    }
}


?>