<?php

class sub_controller_createWallets{
    function __construct($setting){
        global $pdo;
        if (isset($setting))
        {
            $this->name = 'CREATE WALLETS CONTROLLER';
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
            $this->stmt = $this->pdo->prepare('INSERT INTO `wallets_users`
            (`wallets_wlt_id`,
             `account_code`,
             `account_balance`,
             `last_updated`)
                VALUES(:wallets_wlt_id,
                       :account_code,
                       :account_balance,
                       :last_updated)');
            return 'OK';
        }
        else{
            return "COMPONENT DISABLED: " . $this->name;
        }
    }


}


?>