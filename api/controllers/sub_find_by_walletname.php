<?php

class sub_controller_find_by_walletName{
    function __construct($setting){
        global $pdo;
        if (isset($setting))
        {
            $this->name = 'FIND WALLET ID BY NAME CONTROLLER';
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
            $this->stmt = $this->pdo->prepare('SELECT idwallets FROM wallets WHERE wallet_name = :walletname');
            return 'OK';
        }
        else{
            return "COMPONENT DISABLED: " . $this->name;
        }
    }


}


?>