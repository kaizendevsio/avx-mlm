<?php

class sub_controller_createMapsBinaryNode{
    function __construct($setting){
        global $pdo;
        if (isset($setting))
        {
            $this->name = 'CREATE NEW MAPS BINARY NODE CONTROLLER';
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
            $this->stmt = $this->pdo->prepare('INSERT INTO `maps_binary`
            (`account_code`)
                VALUES(:account_code)');
            return 'OK';
        }
        else{
            return "COMPONENT DISABLED: " . $this->name;
        }
    }


}


?>