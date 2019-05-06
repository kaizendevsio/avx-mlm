<?php

class sub_controller_matrix_set_left{
    function __construct($setting){
        global $pdo;
        if (isset($setting))
        {
            $this->name = 'MATRIX SET LEFT CONTROLLER';
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
            $this->stmt = $this->pdo->prepare('UPDATE matrix_binary SET binaryCount_left = :binaryCount_left WHERE account_code = :account_code');
            return 'OK';
        }
        else{
            return "COMPONENT DISABLED: " . $this->name;
        }
    }


}


?>