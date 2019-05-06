<?php

class sub_controller_get_directs{
    function __construct($setting){
        global $pdo;
        if (isset($setting))
        {
            $this->name = 'GET DIRECTS CONTROLLER';
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
            $this->stmt = $this->pdo->prepare('SELECT account_code,username,nname,account_package FROM users_main WHERE upline_account_code = :accountcode');
            return 'OK';
        }
        else{
            return "COMPONENT DISABLED: " . $this->name;
        }
    }


}


?>