<?php

class sub_controller_package_amount{
    function __construct($setting){
        global $pdo;
        if (isset($setting))
        {
            $this->name = 'PACKAGE AMOUNT CONTROLLER';
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
            $this->stmt = $this->pdo->prepare('SELECT * FROM matrix_entry WHERE idmtrix_entry = :packageid');
            return 'OK';
        }
        else{
            return "COMPONENT DISABLED: " . $this->name;
        }
    }


}


?>