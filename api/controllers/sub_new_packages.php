<?php

class sub_controller_createPackages{
    function __construct($setting){
        global $pdo;
        if (isset($setting))
        {
            $this->name = 'CREATE PACKAGES CONTROLLER';
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
            $this->stmt = $this->pdo->prepare('INSERT INTO `matrix_entry`
            (`entry_name`,
             `entry_description`,
             `value`)
                VALUES(:entry_name,
                       :entry_description,
                       :value)');
            return 'OK';
        }
        else{
            return "COMPONENT DISABLED: " . $this->name;
        }
    }


}


?>