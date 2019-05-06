<?php

class sub_controller_createTicket{
    function __construct($setting){
        global $pdo;
        if (isset($setting))
        {
            $this->name = 'CREATE TICKET CONTROLLER';
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
            $this->stmt = $this->pdo->prepare('INSERT INTO `tickets`
            (`ticket_name`,
             `ticket_type`,
             `ticket_hash`,
             `ticket_status`,
             `ticket_created`,
             `ticket_created_by`,
             `ticket_used_by`,
             `ticket_expiry`,
             `ticket_value`,
             `ticket_code`,
             `ticket_use_case`,
             `ticket_owner`)
                VALUES(:ticket_name,
                       :ticket_type,
                       :ticket_hash,
                       :ticket_status,
                       :ticket_created,
                       :ticket_created_by,
                       :ticket_used_by,
                       :ticket_expiry,
                       :ticket_value,
                       :ticket_code,
                       :ticket_use_case,
                       :ticket_owner)');
            return 'OK';
        }
        else{
            return "COMPONENT DISABLED: " . $this->name;
        }
    }


}


?>