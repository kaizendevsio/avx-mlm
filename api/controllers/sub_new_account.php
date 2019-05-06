<?php

class sub_controller_createAccount{
    function __construct($setting){
        global $pdo;
        if (isset($setting))
        {
            $this->name = 'CREATE ACCOUNT CONTROLLER';
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
            $this->stmt = $this->pdo->prepare('INSERT INTO `users_main`
            (`fname`,
             `mname`,
             `lname`,
             `nname`,
             `email`,
             `cp_no`,
             `gender`,
             `username`,
             `psw`,
             `account_code`,
             `upline_account_code`,
             `account_created`,
             `account_type`,
             `account_package`,
             `ipadd`,
             `account_status`)
                VALUES(:fname,
                       :mname,
                       :lname,
                       :nname,
                       :email,
                       :cp_no,
                       :gender,
                       :username,
                       :psw,
                       :account_code,
                       :upline_account_code,
                       :account_created,
                       :account_type,
                       :account_package,
                       :ipadd,
                       :account_status)');
            return 'OK';
        }
        else{
            return "COMPONENT DISABLED: " . $this->name;
        }
    }


}


?>