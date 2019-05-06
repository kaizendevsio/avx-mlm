<?php

class sub_controller_set_log_status{
    function __construct($setting){
        global $pdo;
        if (isset($setting))
        {
            $this->name = 'SET TICKET CONSUME CONTROLLER';
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
            $this->stmt = $this->pdo->prepare('UPDATE system_logs SET log_status = :log_status WHERE log_hash = :log_hash');
            return 'OK';
        }
        else{
            return "COMPONENT DISABLED: " . $this->name;
        }
    }


}


?>