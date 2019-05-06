<?php

class sub_controller_get_all_products{
    function __construct($setting){
        global $pdo;
        if (isset($setting))
        {
            $this->name = 'GET ALL PRODUCTS CONTROLLER';
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
            $this->stmt = $this->pdo->prepare("SELECT * FROM product_items");
            return 'OK';
        }
        else{
            return "COMPONENT DISABLED: " . $this->name;
        }
    }


}


?>