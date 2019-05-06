<?php

class wallet{
    function __construct($userID = '', $walletType = ''){
        $this->userID = $userID;
        $this->walletType = $walletType;
        $this->dtCreated = '';
        $this->dtLastUpdate = '';
        $this->balance = '';
        $this->history = '';

        if (isset($userID))
        {
            if ($userID != '' and $walletType != '')
            {
                $this->createWallets();
            }
            else if ($userID != '' )
            {

            }


        }

        return $this;
    }

    function createWallets(){
        global $controllers;
        global $_datetime;

        if ($controllers->newWallets() == 'OK')
        {
            $data = [
             'wallets_wlt_id' => $this->getWalletID($this->walletType),
             'account_code' =>  $this->userID,
             'account_balance' => 0,
             'last_updated' => $_datetime
             ];

            if ($controllers->newWallets->stmt->execute($data))
            {
                return '200';
            }
            else
            {
                return '500';
            }

        }
        else{
            return $controllers->newWallets();
        }

    }

    function getWalletID($args){
        global $controllers;
        global $_datetime;

        if ($controllers->getWalletID() == 'OK')
        {
            $data = [
             'walletname' => $args
             ];
            $controllers->getWalletID->stmt->execute($data);
            $result = $controllers->getWalletID->stmt->fetch(PDO::FETCH_OBJ);
            $resultCount = $controllers->getWalletID->stmt->rowCount();

            if ($resultCount > 0)
            {
                return $result->idwallets;
            }
            else
            {
                return 'No results returned';
            }

        }
        else{
            return $controllers->getWalletID();
        }

    }

    function topUp($userID,$amount,$walletID,$applyToMain = false){
        global $controllers;
        global $_datetime;

        if ($controllers->walletTopUp() == 'OK')
        {
            $data = [
             'userID' => $userID,
             'amount' => $amount,
             'walletID' => $walletID
             ];

            if ($controllers->walletTopUp->stmt->execute($data))
            {
                if ($applyToMain == true)
                {
                    $this->topUp($userID,$amount,$this->getWalletID('MAIN'));
                }
                return '200';
            }
            else
            {
                return '500';
            }

        }
        else{
            return $controllers->walletTopUp();
        }


    }

    function setBalance($userID,$amount,$walletID){
        global $controllers;
        global $_datetime;

        if ($controllers->setWalletBalance() == 'OK')
        {
            $data = [
             'userID' => $userID,
             'amount' => $amount,
             'walletID' => $walletID
             ];

            if ($controllers->setWalletBalance->stmt->execute($data))
            {
                return '200';
            }
            else
            {
                return '500';
            }

        }
        else{
            return $controllers->setWalletBalance();
        }


    }

    function getWalletBalance($userID,$walletID){
        global $controllers;
        global $_datetime;

        if ($controllers->getWalletBalance() == 'OK')
        {
            $data = [
             'userID' => $userID,
             'walletID' => $walletID
             ];
            $controllers->getWalletBalance->stmt->execute($data);
            $result = $controllers->getWalletBalance->stmt->fetch(PDO::FETCH_OBJ);
            $resultCount = $controllers->getWalletBalance->stmt->rowCount();

            if ($resultCount > 0)
            {
                return $result->account_balance;
            }
            else
            {
                return 'No results returned';
            }

        }
        else{
            return $controllers->getWalletBalance();
        }

    }

    function getWalletBalanceLastModified($userID,$walletID){
        global $controllers;
        global $_datetime;

        if ($controllers->getWalletBalance() == 'OK')
        {
            $data = [
             'userID' => $userID,
             'walletID' => $walletID
             ];
            $controllers->getWalletBalance->stmt->execute($data);
            $result = $controllers->getWalletBalance->stmt->fetch(PDO::FETCH_OBJ);
            $resultCount = $controllers->getWalletBalance->stmt->rowCount();

            if ($resultCount > 0)
            {
                return $result->date_modified;
            }
            else
            {
                return 'No results returned';
            }

        }
        else{
            return $controllers->getWalletBalance();
        }


    }
}


?>