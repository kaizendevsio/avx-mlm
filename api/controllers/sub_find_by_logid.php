<?php

class sub_controller_find_by_logid{
    function __construct($setting){
        global $pdo;
        if (isset($setting))
        {
            $this->name = 'FIND BY LOG ID CONTROLLER';
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
            $this->stmt = $this->pdo->prepare('SELECT * FROM system_logs WHERE idsystem_logs = :log_id');
            return 'OK';
        }
        else{
            return "COMPONENT DISABLED: " . $this->name;
        }
    }


}


?>