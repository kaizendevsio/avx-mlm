<?php

class sub_controller_wallet_balance{
    function __construct($setting){
        global $pdo;
        if (isset($setting))
        {
            $this->name = 'WALLET BALANCE CONTROLLER';
            $this->setting = $setting;
            $this->pdo = $pdo;
        }
        else{
            $this->providers_query();
        }
    }


    function providers_query(){
        if ($this->setting == "1")
        {
            $this->stmt = $this->pdo->prepare('SELECT * FROM wallets_users WHERE account_code = :userID AND wallets_wlt_id = :walletID');
            return 'OK';
        }
        else{
            return "COMPONENT DISABLED: " . $this->name;
        }
    }


}


?>