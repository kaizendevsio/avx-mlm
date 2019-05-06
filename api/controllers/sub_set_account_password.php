<?php

class sub_controller_set_account_password{
    function __construct($setting){
        global $pdo;
        if (isset($setting))
        {
            $this->name = 'SET ACCOUNT PASSWORD CONTROLLER';
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
            $this->stmt = $this->pdo->prepare('UPDATE users_main SET psw = :account_psw WHERE account_code = :userID');
            return 'OK';
        }
        else{
            return "COMPONENT DISABLED: " . $this->name;
        }
    }


}


?>