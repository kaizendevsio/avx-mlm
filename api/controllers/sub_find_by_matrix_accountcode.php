<?php

class sub_controller_find_by_matrix_accountcode{
    function __construct($setting){
        global $pdo;
        if (isset($setting))
        {
            $this->name = 'FIND MATRIX BY USERID CONTROLLER';
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
            $this->stmt = $this->pdo->prepare('SELECT * FROM matrix_binary WHERE account_code = :account_code');
            return 'OK';
        }
        else{
            return "COMPONENT DISABLED: " . $this->name;
        }
    }


}


?>