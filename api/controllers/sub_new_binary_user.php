<?php

class sub_controller_createBinaryUser{
    function __construct($setting){
        global $pdo;
        if (isset($setting))
        {
            $this->name = 'CREATE NEW MATRIX BINARY USER CONTROLLER';
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
            $this->stmt = $this->pdo->prepare('INSERT INTO `matrix_binary`
            (`account_code`,
             `binaryCount_left`,
             `binaryCount_right`,
             `binaryPosition`)
                VALUES(:account_code,
                       :binaryCount_left,
                       :binaryCount_right,
                       :binaryPosition)');
            return 'OK';
        }
        else{
            return "COMPONENT DISABLED: " . $this->name;
        }
    }


}


?>