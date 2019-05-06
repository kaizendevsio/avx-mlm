<?php

class packages{
    function __construct($packageID = '',$name = '',$description = '',$value = '',$points_value = ''){
        $this->packageID = $packageID;
        $this->name = '';
        $this->description = '';
        $this->value = '';
        $this->points_value = '';

        if (isset($userID))
        {
            if ($userID != '')
            {
                $this->createPackage();
            }

        }

        return $this;
    }

    function createPackage(){
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

    function getPackageID($args){
        global $controllers;
        global $_datetime;

        if ($controllers->getPackageID() == 'OK')
        {
            $data = [
             'packagename' => $args
             ];
            $controllers->getPackageID->stmt->execute($data);
            $result = $controllers->getPackageID->stmt->fetch(PDO::FETCH_OBJ);
            $resultCount = $controllers->getPackageID->stmt->rowCount();

            if ($resultCount > 0)
            {
                $this->packageID = $result->idmtrix_entry;
                $this->name = $result->entry_name;
                $this->description = $result->entry_description;
                $this->value = $result->value;
                $this->points_value = $result->points_value;

                return $result->idmtrix_entry;
            }
            else
            {
                return 'No results returned';
            }

        }
        else{
            return $controllers->getPackageID();
        }

    }

    function getPackageName($args){
        global $controllers;
        global $_datetime;

        if ($controllers->getPackageName() == 'OK')
        {
            $data = [
             'packageid' => $args
             ];
            $controllers->getPackageName->stmt->execute($data);
            $result = $controllers->getPackageName->stmt->fetch(PDO::FETCH_OBJ);
            $resultCount = $controllers->getPackageName->stmt->rowCount();

            if ($resultCount > 0)
            {
                $this->packageID = $result->idmtrix_entry;
                $this->name = $result->entry_name;
                $this->description = $result->entry_description;
                $this->value = $result->value;
                $this->points_value = $result->points_value;

                return $result->entry_name;
            }
            else
            {
                return 'No results returned';
            }

        }
        else{
            return $controllers->getPackageName();
        }

    }

    function getPackageAmount($args){
        global $controllers;
        global $_datetime;

        if ($controllers->getPackageAmount() == 'OK')
        {
            $data = [
             'packageid' => $args
             ];
            $controllers->getPackageAmount->stmt->execute($data);
            $result = $controllers->getPackageAmount->stmt->fetch(PDO::FETCH_OBJ);
            $resultCount = $controllers->getPackageAmount->stmt->rowCount();

            if ($resultCount > 0)
            {
                //$this->packageID = $result->idmtrix_entry;
                //$this->name = $result->entry_name;
                //$this->description = $result->entry_description;
                //$this->value = $result->value;
                //$this->points_value = $result->points_value;

                return $result->value;
            }
            else
            {
                return 'No results returned';
            }

        }
        else{
            return $controllers->getPackageAmount();
        }

    }


}


?>