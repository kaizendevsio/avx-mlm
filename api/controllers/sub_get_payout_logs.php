<?php

class sub_controller_get_payout_logs{
    function __construct($setting){
        global $pdo;
        if (isset($setting))
        {
            $this->name = 'GET PAYOUT LOGS CONTROLLER';
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
            $this->stmt = $this->pdo->prepare("SELECT * FROM system_logs WHERE message_code = 'USER_PAYOUT'");
            return 'OK';
        }
        else{
            return "COMPONENT DISABLED: " . $this->name;
        }
    }


}


?>