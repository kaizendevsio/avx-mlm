<?php

class sub_controller_createProduct{
    function __construct($setting){
        global $pdo;
        if (isset($setting))
        {
            $this->name = 'CREATE PRODUCT CONTROLLER';
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
            $this->stmt = $this->pdo->prepare('INSERT INTO `product_items`
            (`product_ID`,
             `product_name`,
             `product_description`,
             `product_price`,
             `product_qty`,
             `product_type`,
             `product_category`,
             `product_status`,
             `product_snapshot`)
                VALUES(:product_ID,
                       :product_name,
                       :product_description,
                       :product_price,
                       :product_qty,
                       :product_type,
                       :product_category,
                       :product_status,
                       :product_snapshot)');
            return 'OK';
        }
        else{
            return "COMPONENT DISABLED: " . $this->name;
        }
    }


}


?>