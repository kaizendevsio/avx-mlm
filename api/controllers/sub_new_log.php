<?php

class sub_controller_createSystemLog{
    function __construct($setting){
        global $pdo;
        if (isset($setting))
        {
            $this->name = 'CREATE SYSTEM LOG CONTROLLER';
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
            $this->stmt = $this->pdo->prepare('INSERT INTO `system_logs`
            (`log_title`,
             `message`,
             `message_code`,
             `timestamp`,
             `log_type`,
             `log_viewed`,
             `log_hash`,
             `log_status`,
             `log_image`,
             `log_value`,
             `log_count`,
             `log_purchase`,
             `log_username`)
                VALUES(:log_title,
                       :message,
                       :message_code,
                       :timestamp,
                       :log_type,
                       :log_viewed,
                       :log_hash,
                       :log_status,
                       :log_image,
                       :log_value,
                       :log_count,
                       :log_purchase,
                       :log_username)');
            return 'OK';
        }
        else{
            return "COMPONENT DISABLED: " . $this->name;
        }
    }


}


?>