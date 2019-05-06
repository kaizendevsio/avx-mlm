<?php

class sub_controller_createProductTx{
    function __construct($setting){
        global $pdo;
        if (isset($setting))
        {
            $this->name = 'CREATE PRODUCT TX CONTROLLER';
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
            $this->stmt = $this->pdo->prepare('INSERT INTO `product_transactions`
            (`product_ID`,
             `tx_type`,
             `tx_buyer`,
             `tx_stockist`,
             `tx_code_used`,
             `tx_status`,
             `tx_amount`,
             `tx_cost`)
                VALUES(:product_ID,
                       :tx_type,
                       :tx_buyer,
                       :tx_stockist,
                       :tx_code_used,
                       :tx_status,
                       :tx_amount,
                       :tx_cost)');
            return 'OK';
        }
        else{
            return "COMPONENT DISABLED: " . $this->name;
        }
    }


}


?>