<?php

class sub_controller_find_by_card_uid{
    function __construct($setting){
        global $pdo;
        if (isset($setting))
        {
            $this->name = 'FIND BY CARD_UID CONTROLLER';
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
            $this->stmt = $this->pdo->prepare('SELECT * FROM user_card WHERE card_uid = :card_uid');
            return 'OK';
        }
        else{
            return "COMPONENT DISABLED: " . $this->name;
        }
    }


}


?>