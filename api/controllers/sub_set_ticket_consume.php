<?php

class sub_controller_set_ticket_consume{
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
            $this->stmt = $this->pdo->prepare('UPDATE tickets SET ticket_used_by = :userID, ticket_status = 2 WHERE ticket_code = :ticket_code');
            return 'OK';
        }
        else{
            return "COMPONENT DISABLED: " . $this->name;
        }
    }


}


?>