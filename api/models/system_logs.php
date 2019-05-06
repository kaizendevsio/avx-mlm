<?php

class system_logs{
    function __construct(){
        $this->id = '';
        $this->title =  '';
        $this->message =  '';
        $this->code =  '';
        $this->timestamp =  '';
        $this->type =  '';
        $this->viewed = '';
        $this->hash = '';
        $this->status = '';
        $this->image = '';
        $this->value = '';
        $this->count = '';
        $this->purchase = '';
        $this->username = '';
    }

    function findById($logID){
        global $controllers;
        if ($controllers->findByLogId() == 'OK')
        {
            $controllers->findByLogId->stmt->execute(['log_id' => cleanString($logID)]);
            $result = $controllers->findByLogId->stmt->fetch(PDO::FETCH_OBJ);
            $resultCount = $controllers->findByLogId->stmt->rowCount();

            if ($resultCount > 0)
            {
                $this->id = $resultCount;
                $this->title = $result->log_title;
                $this->message = $result->message;
                $this->code = $result->message_code;
                $this->timestamp = $result->timestamp;
                $this->type = $result->log_type;
                $this->viewed = $result->log_viewed;
                $this->hash = $result->log_hash;
                $this->status = $result->log_status;
                $this->image = $result->log_image;
                $this->value = $result->log_value;
                $this->count = $result->log_count;
                $this->purchase = $result->log_purchase;
                $this->username = $result->log_username;

                return $this;
            }
            else
            {
                $this->count = 0;
                $message_txt = 'No results returned';
                $status = '500';

                return $status;
            }

        }
        else{
            $status = '301';
            $message_txt = $controllers->findByLogId();

            return $message_txt;
        }
    }

    function createLog($title,$message,$code,$type,$viewed,$status,$image,$value,$count,$purchase, $username = ''){
        global $controllers;
        global $_datetime;

        if ($controllers->newSystemLog() == 'OK')
        {
            $data = [
             'log_title' => $title,
             'message' =>  $message,
             'message_code' => $code,
             'timestamp' => $_datetime,
             'log_type' => $type,
             'log_viewed' => $viewed,
             'log_hash' => sha1($title . $message . $_datetime . $code . $status),
             'log_status' => $status,
             'log_image' => $image,
             'log_value' => $value,
             'log_count' => $count,
             'log_username' => $username,
             'log_purchase' => $purchase
             ];

            if ($controllers->newSystemLog->stmt->execute($data))
            {
                return '200';
            }
            else
            {
                return '500';
            }

        }
        else{
            return $controllers->newSystemLog();
        }

    }

    function getAllLogs(){

        global $controllers;
        if ($controllers->getAllLogs() == 'OK')
        {
            $controllers->getAllLogs->stmt->execute();
            $result = $controllers->getAllLogs->stmt->fetchAll(PDO::FETCH_OBJ);
            $resultCount = $controllers->getAllLogs->stmt->rowCount();

            if ($resultCount > 0)
            {
                $message_txt = 'Account found with ' . $resultCount . ' result(s)';
                $status = '200';

                //RETURN RESULT OBJECT
                return $result;

            }
            else
            {
                return '';
                $status = '500';
            }

        }
        else{
            $status = '301';
            return $controllers->getAllLogs();
        }


    }

    function getPayoutLogs(){

        global $controllers;
        if ($controllers->getPayoutLogs() == 'OK')
        {
            $controllers->getPayoutLogs->stmt->execute();
            $result = $controllers->getPayoutLogs->stmt->fetchAll(PDO::FETCH_OBJ);
            $resultCount = $controllers->getPayoutLogs->stmt->rowCount();

            if ($resultCount > 0)
            {
                $message_txt = 'Account found with ' . $resultCount . ' result(s)';
                $status = '200';

                //RETURN RESULT OBJECT
                return $result;

            }
            else
            {
                return '';
                $status = '500';
            }

        }
        else{
            $status = '301';
            return $controllers->getPayoutLogs();
        }


    }

    function updateStatus($args){
        global $controllers;
        global $_datetime;

        if ($controllers->setLogStatus() == 'OK')
        {
            $data = [
             'log_hash' => $this->hash,
             'log_status' => $args
             ];

            if ($controllers->setLogStatus->stmt->execute($data))
            {
                return '200';
            }
            else
            {
                return '500';
            }

        }
        else{
            return $controllers->setLogStatus();
        }

    }
}

?>