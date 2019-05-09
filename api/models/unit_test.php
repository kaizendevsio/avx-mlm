<?php
include_once('../models/system_stats.php');

class unitTest{
    function __construct(){
        $this->startIndex = 0;
        $this->userCreateCount;
        $this->packagePremium_Count;
        $this->packageBasic_Count;
        $this->clientName;
    }

    function start(){
        $userAccount = new accounts();
        $systemStats = new system_stats();
        $package = new packages;
        $unitTestResult = new unitTestResult();
        $wallet = new wallet;

        $unitTestResult->status = 102;

        // TEMP VARS
       // $results = [];

        $packageToEncode = "BASIC";
        $packagePremium_Count_i = 0;
        $packageBasic_Count_i = 0;

        while ($this->startIndex < $this->userCreateCount)
        {
            if ($packageBasic_Count_i < $this->packageBasic_Count)
            {
                $packageToEncode = "BASIC";              
            }
            else{
                $packageToEncode = "PREMIUM";                
            }

            $tmp_name = $this->clientName . '_' . $this->startIndex;
            $txResult = $userAccount->newUser("first name " .$tmp_name ,"middle name " . $tmp_name, "last name " . $tmp_name,"nick name " . $tmp_name,"email " .$tmp_name,"0","gender","123",$tmp_name, $this->clientName . '_' . (floatval($this->startIndex) - 1),'USER',"",$packageToEncode);

            //array_push($results,$txResult);

            if ($packageBasic_Count_i < $this->packageBasic_Count)
            {              
                $packageBasic_Count_i++;
            }
            else{             
                $packagePremium_Count_i++;
            }

            $this->startIndex++;
        }

        // COMPUTE TOTAL PAYINS / PAYOUT

        $unitTestResult->totalDirects = $systemStats->getTotalPayouts($wallet->getWalletID("DR"));
        $unitTestResult->totalPayout = $systemStats->getTotalPayouts($wallet->getWalletID("MAIN"));
        $unitTestResult->totalPremiumPackage = $systemStats->getTotalSystemEncoded($package->getPackageID("PREMIUM"));
        $unitTestResult->totalBasicPackage = $systemStats->getTotalSystemEncoded($package->getPackageID("BASIC"));
        $unitTestResult->totalEncoded = floatval($unitTestResult->totalPremiumPackage) + floatval($unitTestResult->totalBasicPackage);

        $tmp_totalGrossProfit = (floatval($package->getPackageAmount($package->getPackageID("BASIC"))) * floatval($unitTestResult->totalBasicPackage)) + (floatval($package->getPackageAmount($package->getPackageID("PREMIUM"))) * floatval($unitTestResult->totalPremiumPackage));
        $unitTestResult->totalGrossProfit = $tmp_totalGrossProfit;
        $unitTestResult->totalNetProfit = floatval($tmp_totalGrossProfit) - floatval($unitTestResult->totalPayout[0]->mainBalance);
        $unitTestResult->status = 200;

        return $unitTestResult;
    }

}

class unitTestResult{
    function __construct(){
        $this->totalNetProfit;
        $this->totalGrossProfit;
        $this->totalPayout;
        $this->totalEncoded;
        $this->totalPremiumPackage;
        $this->totalBasicPackage;
        $this->totalDirects;
        $this->status;
    }
}


?>