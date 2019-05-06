<?php

class sub_controller_find_by_packageId{
    function __construct($setting){
        global $pdo;
        if (isset($setting))
        {
            $this->name = 'FIND PACKAGE NAME BY ID CONTROLLER';
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