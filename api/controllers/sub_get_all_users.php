<?php

class sub_controller_get_all_users{
    function __construct($setting){
        global $pdo;
        if (isset($setting))
        {
            $this->name = 'GET ALL USERS CONTROLLER';
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
            $this->stmt = $this->pdo->prepare("SELECT account_status,idusers,account_code,username,CONCAT(fname, ' ', lname) as fullname,email,upline_account_code,account_package,account_created,account_token FROM users_main");
            return 'OK';
        }
        else{
            return "COMPONENT DISABLED: " . $this->name;
        }
    }


}


?>