<?php

class sub_controller_set_account_token{
    function __construct($setting){
        global $pdo;
        if (isset($setting))
        {
            $this->name = 'SET ACCOUNT TOKEN CONTROLLER';
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
            $this->stmt = $this->pdo->prepare('UPDATE users_main SET account_token = :account_token, account_status = 1 WHERE account_code = :userID');
            return 'OK';
        }
        else{
            return "COMPONENT DISABLED: " . $this->name;
        }
    }


}


?>