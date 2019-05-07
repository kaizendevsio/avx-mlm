<?php

class sub_controller_find_by_card_userid{
    function __construct($setting){
        global $pdo;
        if (isset($setting))
        {
            $this->name = 'FIND BY CARD_USER_ID CONTROLLER';
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
            $this->stmt = $this->pdo->prepare('SELECT * FROM user_card WHERE account_code = :accountcode');
            return 'OK';
        }
        else{
            return "COMPONENT DISABLED: " . $this->name;
        }
    }


}


?>