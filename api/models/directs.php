<?php

class Directs{
    function __construct($userID){
        $this->userID = $userID;
        $this->count = '';
        $this->items = [];

        return $this->getDirects();
    }

    function getDirects(){
        global $controllers;
           if ($controllers->getDirects() == 'OK')
        {
            $controllers->getDirects->stmt->execute(['accountcode' => cleanString($this->userID)]);
            $result = $controllers->getDirects->stmt->fetchAll(PDO::FETCH_OBJ);
            $resultCount = $controllers->getDirects->stmt->rowCount();

            if ($resultCount > 0)
            {
                $this->count = $resultCount;
                $this->items = $result;

                return $this;
            }
            else
            {
                $this->count = 0;
                $message_txt = 'No results returned';
                $status = '500';

                return $message_txt;
            }

        }
        else{
            $status = '301';
            $message_txt = $controllers->getDirects();

            return $message_txt;
        }
    }

}

?>