<?php
class tickets{
    function __construct($ticketID = ''){
        $this->ticketID = '';
        $this->ticket_name = '';
        $this->ticket_type = '';
        $this->ticket_created = '';
        $this->ticket_expiry = '';
        $this->ticket_used_by = '';
        $this->ticket_created_by = '';
        $this->ticket_value = '';
        $this->ticket_status = '';
        $this->ticket_hash = '';
        $this->ticket_code = $ticketID;
        $this->count = 0;

        if (isset($ticketID))
        {
            if ($ticketID != '')
            {
                $this->findByCode($ticketID);
            }

        }
        return $this;
    }

    function findByCode($ticketCode){
        global $controllers;
        if ($controllers->findByTicketCode() == 'OK')
        {
            $controllers->findByTicketCode->stmt->execute(['ticket_code' => cleanString($ticketCode)]);
            $result = $controllers->findByTicketCode->stmt->fetch(PDO::FETCH_OBJ);
            $resultCount = $controllers->findByTicketCode->stmt->rowCount();

            if ($resultCount > 0)
            {
                $this->count = $resultCount;
                $this->ticketID = $result->idtickets;
                $this->ticket_name = $result->ticket_name;
                $this->ticket_type = $result->ticket_type;
                $this->ticket_created = $result->ticket_created;
                $this->ticket_expiry = $result->ticket_expiry;
                $this->ticket_used_by = $result->ticket_used_by;
                $this->ticket_created_by = $result->ticket_created_by;
                $this->ticket_value = $result->ticket_value;
                $this->ticket_status = $result->ticket_status;
                $this->ticket_hash = $result->ticket_hash;
                $this->ticket_code = $result->ticket_code;

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
            $message_txt = $controllers->findByTicketCode();

            return $message_txt;
        }
    }

    function createTicket($tName,$tType,$tStatus,$tCreatedBy,$tUsedBy,$tValue,$tUseCase = 1,$tOwner = "ADMIN",$tPcs = 1){
        global $controllers;
        global $_datetime;

        if ($controllers->newTicket() == 'OK')
        {

            for ($i = 0; $i < $tPcs; $i++)
            {
                $data = [
            'ticket_name' => $tName,
            'ticket_type' =>  $tType,
            'ticket_hash' => sha1($tName . $tType . $_datetime . $tValue . $tCreatedBy),
            'ticket_status' => $tStatus,
            'ticket_created' => $_datetime,
            'ticket_created_by' => $tCreatedBy,
            'ticket_used_by' => $tUsedBy,
            'ticket_expiry' => date('Y-m-d', strtotime($_datetime . ' + 90 days')),
            'ticket_value' => $tValue,
            'ticket_code' => generateRandomString(8),
            'ticket_use_case' => $tUseCase,
            'ticket_owner' => $tOwner
            ];

                if ($controllers->newTicket->stmt->execute($data))
                {
                   // return '200';
                }
                else
                {
                    return '500';
                }
            }

            return '200';




        }
        else{
            return $controllers->newTicket();
        }

    }

    function consume($userID){
        global $controllers;
        global $_datetime;

        if ($controllers->setTicketConsume() == 'OK')
        {
            $data = [
             'ticket_code' => $this->ticket_code,
             'userID' => $userID
             ];

            if ($controllers->setTicketConsume->stmt->execute($data))
            {
                return '200';
            }
            else
            {
                return '500';
            }

        }
        else{
            return $controllers->setTicketConsume();
        }

    }

    function getAllTicket(){

        global $controllers;
        if ($controllers->getAllTicket() == 'OK')
        {
            $controllers->getAllTicket->stmt->execute();
            $result = $controllers->getAllTicket->stmt->fetchAll(PDO::FETCH_OBJ);
            $resultCount = $controllers->getAllTicket->stmt->rowCount();

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
            return $controllers->getAllTicket();
        }


    }

    function buyTicket($cType,$cCount,$cPm,$cTx,$cRemarks,$username){

        $package = new packages;
        $package->getPackageID($cType);

        $total_value = floatval($package->value) * floatval($cCount);

        $this->createLog("BUY CUPON", "A member with username: " . $username . " paid on " . $cPm . " with tx no.: " . $cTx . " to buy " . $cCount . " " . $cType . " cupons. Remarks: " .$cRemarks , "CASH_IN_CUPON", "1", "NO" , "2", "",$total_value , $cCount,$cType,$username);


    }

}


?>