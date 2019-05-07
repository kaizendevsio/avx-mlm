<?php
class card{
    function __construct($userID = ''){
        $this->account_code = null;
        $this->name = null;
        $this->note = null;
        $this->role = null;
        $this->type = null;
        $this->uid = null;
        $this->permissions = [];
        $this->create_timestamp = null;
        $this->modify_timestamp = null;
        $this->effective_date = null;
        $this->status = null;
        $this->expiry = null;

        if (isset($cardID))
        {
            if ($cardID != '')
            {
                $this->findByUserId($userID);
            }
        }
    }

    function findByUserId($userID){
        global $controllers;
        if ($controllers->findByCardUserID() == 'OK')
        {
            $controllers->findByCardUserID->stmt->execute(['accountcode' => cleanString($userID)]);
            $result = $controllers->findByCardUserID->stmt->fetch(PDO::FETCH_OBJ);
            $resultCount = $controllers->findByCardUserID->stmt->rowCount();

            if ($resultCount > 0)
            {
                $this->count = $resultCount;
                $this->account_code = $result->account_code;
                $this->name = $result->card_name;
                $this->note = $result->card_note;
                $this->role = $result->card_role;
                $this->type = $result->card_type;
                $this->uid = $result->card_uid;
                $this->permissions = $result->card_permissions;
                $this->create_timestamp = $result->card_create_timestamp;
                $this->modify_timestamp = $result->card_modify_timestamp;
                $this->effective_date = $result->card_effective_date;
                $this->status = $result->card_status;
                $this->expiry = $result->card_expiry;

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
            $message_txt = $controllers->findByCardUserID();

            return $message_txt;
        }
    }

    function findByCardUID($cardUID){
        global $controllers;
        if ($controllers->findByCardUID() == 'OK')
        {
            $controllers->findByCardUID->stmt->execute(['card_uid' => cleanString($cardUID)]);
            $result = $controllers->findByCardUID->stmt->fetch(PDO::FETCH_OBJ);
            $resultCount = $controllers->findByCardUID->stmt->rowCount();

            if ($resultCount > 0)
            {
                $this->count = $resultCount;
                $this->account_code = $result->account_code;
                $this->name = $result->card_name;
                $this->note = $result->card_note;
                $this->role = $result->card_role;
                $this->type = $result->card_type;
                $this->uid = $result->card_uid;
                $this->permissions = $result->card_permissions;
                $this->create_timestamp = $result->card_create_timestamp;
                $this->modify_timestamp = $result->card_modify_timestamp;
                $this->effective_date = $result->card_effective_date;
                $this->status = $result->card_status;
                $this->expiry = $result->card_expiry;

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
            $message_txt = $controllers->findByCardUID();

            return $message_txt;
        }
    }

    function create($options){
        global $controllers;
        global $_datetime;

        if ($controllers->newCard() == 'OK')
        {
            $data = [
             'account_code' => $options->account_code,
             'card_name' =>  $options->name,
             'card_note' =>  $options->note,
             'card_role' =>  $options->role,
             'card_type' => $options->type,
             'card_uid' => sha1(generateRandomString(32)),
             'card_permissions' => $options->permissions,
             'card_effective_date' => date('Y-m-d', strtotime($options->effective_date)),
             'card_status' => $options->status,
             'card_expiry' => date('Y-m-d', strtotime($_datetime . ' + 365 days'))
             ];

            if ($controllers->newCard->stmt->execute($data))
            {
                return '200';
            }
            else
            {
                return '500';
            }

        }
        else{
            return $controllers->newCard();
        }

    }

    function getAll(){

        global $controllers;
        if ($controllers->getAllCards() == 'OK')
        {
            $controllers->getAllCards->stmt->execute();
            $result = $controllers->getAllCards->stmt->fetchAll(PDO::FETCH_OBJ);
            $resultCount = $controllers->getAllCards->stmt->rowCount();

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
            return $controllers->getAllCards();
        }


    }

}


?>