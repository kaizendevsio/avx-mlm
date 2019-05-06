<?php
class blockchain{
    function __construct(){
        $app = new app;
        $this->ApiKey = 'DUYFpphQJHkn7I222T5ouOtDRZAkJmtflvMXpHKTEQs';
        $this->ServiceUrl = 'https://www.blockonomics.co/api/';
        $this->xPubKey = 'xpub6DXT61y6phrPnKmoU899W5ebaB5y2sPJ9MsdmHG1SW5dg1bT3VGbPk8hzT2bejRaVanCSCrmQhcEQguyeqJEPRZss52wmFYcsRjDa8yHwUx';
        $this->invoiceID = $app->GenerateNewUID();
    }

    function CreateNewPaymentRequest(){
        global $controllers;
        global $_datetime;

        if ($controllers->newBlockchainPayment() == 'OK')
        {
         $options = array(
            'http' => array(
              'header'  => 'Authorization: Bearer ' . $this->ApiKey,
              'method'  => 'POST',
              'content' => ''
              )
         );

         $context = stream_context_create($options);
         $contents = file_get_contents($this->ServiceUrl . 'new_address', false, $context);
         $object = json_decode($contents);

         $blockchainResponse = new blockchainResponse;
         $blockchainResponse->ApiResponse = $object;

         $data = [
            'wallets_wlt_id' => $this->getWalletID($this->walletType),
            'account_code' =>  $this->userID,
            'account_balance' => 0,
            'last_updated' => $_datetime
            ];

         if ($controllers->newWallets->stmt->execute($data))
         {
             $blockchainResponse->Status = '200';
         }
         else
         {
             $blockchainResponse->Status = '500';
         }
         return $object;

        }
        else{
            return $controllers->newBlockchainPayment();
        }
    }

    function FindByAccountCode($options){
        global $controllers;
        global $_datetime;

        if ($controllers->findByMatrixUserId() == 'OK')
        {
            $data = [
             'account_code' => $options
             ];

            $controllers->findByMatrixUserId->stmt->execute($data);
            $result = $controllers->findByMatrixUserId->stmt->fetch(PDO::FETCH_OBJ);
            $resultCount = $controllers->findByMatrixUserId->stmt->rowCount();

            if ($resultCount > 0)
            {
                return $result;
            }
            else
            {
                return 'No results returned';
            }

        }
        else{
            return $controllers->findByMatrixUserId();
        }
    }

    function NodeTopUp($options){
        global $controllers;

        if ($options->binaryPosition == '1')
        {
            if ($controllers->matrixBinaryTopUpLeft() == 'OK')
            {
                $data = [
                 'account_code' => $options->account_code,
                 'binaryCount_left' => $options->binaryCount_left
                 ];

                if ($controllers->matrixBinaryTopUpLeft->stmt->execute($data))
                {
                    return '200';
                }
                else
                {
                    return '500';
                }

            }
            else{
                return $controllers->matrixBinaryTopUpLeft();
            }
        }
        else{
            if ($controllers->matrixBinaryTopUpRight() == 'OK')
            {
                $data = [
                 'account_code' => $options->account_code,
                 'binaryCount_right' => $options->binaryCount_right
                 ];

                if ($controllers->matrixBinaryTopUpRight->stmt->execute($data))
                {
                    return '200';
                }
                else
                {
                    return '500';
                }

            }
            else{
                return $controllers->matrixBinaryTopUpRight();
            }
        }



    }

    function NodeSetBalance($options){
        global $controllers;

        if ($controllers->matrixSetLeft() == 'OK')
        {
            $data = [
             'account_code' => $options->account_code,
             'binaryCount_left' => $options->binaryCount_left
             ];

            if ($controllers->matrixSetLeft->stmt->execute($data))
            {
                //return '200';
            }
            else
            {
                //return '500';
            }

        }
        else{
            return $controllers->matrixSetLeft();
        }


        if ($controllers->matrixSetRight() == 'OK')
        {
            $data = [
             'account_code' => $options->account_code,
             'binaryCount_right' => $options->binaryCount_right
             ];

            if ($controllers->matrixSetRight->stmt->execute($data))
            {
                return '200';
            }
            else
            {
                return '500';
            }

        }
        else{
            return $controllers->matrixSetRight();
        }

    }

    function ConsumePair($options){
        $node = new Node;
        $package = new packages;
        $wallet = new wallet;
        $user_pair = 0;

        $node = $this->FindByAccountCode($options->account_code);

        if ($node->binaryCount_left > 0 or $node->binaryCount_right > 0)
        {
            // ADD TO PAIR COUNTER
            $wallet->topUp($options->account_code,($user_pair),$wallet->getWalletID('PRB'),true);
            $wallet->topUp($options->account_code,1,$wallet->getWalletID('PR_COUNTER'),true);

            // ASSES WHICH LEG TO CALCULATE
            if ($node->binaryCount_left > $node->binaryCount_right)
            {
                $binaryCount_left = floatval($node->binaryCount_left) - floatval($node->binaryCount_right);

                $current_Node = new Node;
                $current_Node->account_code = $node->account_code;
                $current_Node->binaryPosition = '1';
                $current_Node->binaryCount_left = $binaryCount_left;
                $current_Node->binaryCount_right = 0;

                if ($options->account_package == $package->getPackageID('SILVER'))
                {
                	$user_pair = 500 * floatval($node->binaryCount_right);
                }
                else if ($options->account_package == $package->getPackageID('GOLD'))
                {
                	$user_pair = 1000 * floatval($node->binaryCount_right);
                }

                $this->NodeSetBalance($current_Node);
                return true;
            }
            else if($node->binaryCount_left < $node->binaryCount_right) {
                $binaryCount_right = floatval($node->binaryCount_right) - floatval($node->binaryCount_left);

                $current_Node = new Node;
                $current_Node->account_code = $node->account_code;
                $current_Node->binaryPosition = '2';
                $current_Node->binaryCount_right = $binaryCount_right;
                $current_Node->binaryCount_left = 0;

                if ($options->account_package == $package->getPackageID('SILVER'))
                {
                	$user_pair = 500 * floatval($node->binaryCount_left);
                }
                else if ($options->account_package == $package->getPackageID('GOLD'))
                {
                	$user_pair = 1000 * floatval($node->binaryCount_left);
                }

                $this->NodeSetBalance($current_Node);
                return true;
            } else if($node->binaryCount_left == $node->binaryCount_right) {
                $binaryCount_right = 0;

                $current_Node = new Node;
                $current_Node->account_code = $node->account_code;
                $current_Node->binaryPosition = '2';
                $current_Node->binaryCount_right = $binaryCount_right;

                if ($options->account_package == $package->getPackageID('SILVER'))
                {
                	$user_pair = 500 * floatval($node->binaryCount_left);
                }
                else if ($options->account_package == $package->getPackageID('GOLD'))
                {
                	$user_pair = 1000 * floatval($node->binaryCount_left);
                }

                $this->NodeSetBalance($current_Node);

                $current_Node->account_code = $node->account_code;
                $current_Node->binaryPosition = '1';
                $current_Node->binaryCount_left = 0;
                $current_Node->binaryCount_right = 0;

                $this->NodeSetBalance($current_Node);

                return true;
            }
            else{
                return false;
            }
        }
        else{
            return false;
        }


    }

    function CheckForPairing($options){
        global $_date;
        $maps = new maps;
        $wallet = new wallet;
        $package = new packages;

        $wallet->getWalletBalance($options->account_code,$wallet->getWalletID('PR_COUNTER'));
        $maps->FindByAccountCode($options->account_code);
        $node = $this->FindByAccountCode($options->account_code);

        $dateCounter = date('Y-m-d', strtotime($maps->maps_modify_timestamp . ' + 7 days'));
        $flushOutCount = 0;
        if ($options->account_package == $package->getPackageID('SILVER'))
        {
            $flushOutCount = 10;
        }
        else if ($options->account_package == $package->getPackageID('GOLD'))
        {
            $flushOutCount = 12;
        }


        // PROCEED CHECKING
        if ($node->binaryCount_left > 0 and $node->binaryCount_right > 0)
        {
            if ($node->binaryCount_left > $node->binaryCount_right or $node->binaryCount_left < $node->binaryCount_right or $node->binaryCount_left == $node->binaryCount_right)
            {
                // CHECK FOR FLUSHOUTS
                if ($wallet->balance > $flushOutCount)
                {
                    if ($dateCounter > $_date)
                    {
                        return false;
                    }
                    else
                    {
                        //RESET FLUSHOUT COUNTER
                        $wallet->setBalance($options->account_code,0,$wallet->getWalletID('PR_COUNTER'));

                        // IF NO FLUSH OUT, THROW TRUE
                        return true;
                    }
                }
                else
                {
                    // IF NO FLUSH OUT, THROW TRUE
                    return true;
                }
            }
            else{
                return false;
            }
        }
        else{
            return false;
        }

    }
}

class blockchainResponse{
    function __construct(){
        $this->ApiResponse;
        $this->Status;
    }
}

?>