<?php

class sub_controller_products_setBalance_topup{
    function __construct($setting){
        global $pdo;
        if (isset($setting))
        {
            $this->name = 'PRODUCT TOP UP CONTROLLER';
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
            $this->stmt = $this->pdo->prepare('UPDATE product_items SET product_qty = product_qty + :amount WHERE product_ID = :product_ID');
            return 'OK';
        }
        else{
            return "COMPONENT DISABLED: " . $this->name;
        }
    }


}


?>