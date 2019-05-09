<?php

class sub_controller_get_users_wdirects{
    function __construct($setting){
        global $pdo;
        if (isset($setting))
        {
            $this->name = 'GET USERS WITH DIRECTS CONTROLLER';
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
            $this->stmt = $this->pdo->prepare("SELECT um.account_code,wu.account_balance as directs FROM users_main as um INNER JOIN wallets_users as wu ON um.account_code = wu.account_code WHERE wu.wallets_wlt_id = 5 and wu.account_balance >= :directs_count");
            return 'OK';
        }
        else{
            return "COMPONENT DISABLED: " . $this->name;
        }
    }


}


?>