<?php

class sub_controller_find_by_productId{
    function __construct($setting){
        global $pdo;
        if (isset($setting))
        {
            $this->name = 'FIND PRODUCT BY ID CONTROLLER';
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
            $this->stmt = $this->pdo->prepare('SELECT * FROM product_items WHERE product_ID = :productid');
            return 'OK';
        }
        else{
            return "COMPONENT DISABLED: " . $this->name;
        }
    }


}


?>