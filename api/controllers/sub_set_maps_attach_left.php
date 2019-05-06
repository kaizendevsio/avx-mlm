<?php

class sub_controller_set_maps_attach_left{
    function __construct($setting){
        global $pdo;
        if (isset($setting))
        {
            $this->name = 'SET MAPS ATTACH LEFT CONTROLLER';
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
            $this->stmt = $this->pdo->prepare('UPDATE maps_binary SET maps_left_account_code = :maps_left_account_code WHERE account_code = :account_code');
            return 'OK';
        }
        else{
            return "COMPONENT DISABLED: " . $this->name;
        }
    }


}


?>