<?php

class sub_controller_auth{
    function __construct($setting){
        global $pdo;
        if (isset($setting))
        {
            $this->name = 'AUTH CONTROLLER';
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
            $this->stmt = $this->pdo->prepare('SELECT * FROM users_main WHERE username = :username AND psw = :psw');
            return 'OK';
        }
        else{
            return "COMPONENT DISABLED: " . $this->name;
        }
    }


}


?>