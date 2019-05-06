<?php

class sub_controller_new_blockchain_payment{
    function __construct($setting){
        global $pdo;
        if (isset($setting))
        {
            $this->name = 'NEW BLOCKCHAIN PAYMENT CONTROLLER';
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
            $this->stmt = $this->pdo->prepare('INSERT INTO `blockchain_tx`
            (`account_code`,
             `tx_mode`,
             `tx_wallet_amount`,
             `tx_amount`,
             `tx_status`,
             `tx_expiry`,
             `tx_remarks`,
             `tx_hash`)
                VALUES(:account_code,
                       :tx_mode,
                       :tx_wallet_amount,
                       :tx_amount,
                       :tx_status,
                       :tx_expiry,
                       :tx_remarks,
                       :tx_hash)');
            return 'OK';
        }
        else{
            return "COMPONENT DISABLED: " . $this->name;
        }
    }


}


?>