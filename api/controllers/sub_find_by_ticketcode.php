<?php

class sub_controller_find_by_ticketcode{
    function __construct($setting){
        global $pdo;
        if (isset($setting))
        {
            $this->name = 'FIND BY TICKET CODE CONTROLLER';
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
            $this->stmt = $this->pdo->prepare('SELECT * FROM tickets WHERE ticket_code = :ticket_code');
            return 'OK';
        }
        else{
            return "COMPONENT DISABLED: " . $this->name;
        }
    }


}


?>