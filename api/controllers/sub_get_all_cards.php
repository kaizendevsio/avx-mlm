<?php

class sub_controller_get_all_cards{
    function __construct($setting){
        global $pdo;
        if (isset($setting))
        {
            $this->name = 'GET ALL CARDS CONTROLLER';
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
            $this->stmt = $this->pdo->prepare("SELECT * FROM user_card");
            return 'OK';
        }
        else{
            return "COMPONENT DISABLED: " . $this->name;
        }
    }


}


?>