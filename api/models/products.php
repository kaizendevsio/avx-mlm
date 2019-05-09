<?php
include('../models/tickets.php');
include('../models/wallet.php');

class products{
    function __construct($productID = ''){
        $this->productID = $productID;
        $this->name = '';
        $this->description = '';
        $this->type = '';
        $this->category = '';
        $this->status = '';
        $this->price = 0;
        $this->quantity = 0;
        $this->create_date = '';
        $this->modify_date = '';
        $this->snapshot = '';

        if (isset($productID))
        {
            if ($productID != '')
            {
                $this->getProductID($productID);
            }

        }

    }

    function createProduct($args){
        global $controllers;
        global $_datetime;

        if ($controllers->newProduct() == 'OK')
        {
            $this->productID = generateRandomString(4) . '_' . generateRandomString(6);

            $data = [
             'product_ID' => $this->productID,
             'product_name' =>  $args->Name,
             'product_description' => $args->Description,
             'product_price' => $args->price,
             'product_qty' => $args->qty,
             'product_type' => $args->type,
             'product_category' => $args->category,
             'product_status' => $args->status,
             'product_snapshot' => $args->snapshot
             ];

            if ($controllers->newProduct->stmt->execute($data))
            {
                return '200';
            }
            else
            {
                return '500';
            }

        }
        else{
            return $controllers->newProduct();
        }

    }

    function getByProductID($args){
        global $controllers;
        global $_datetime;

        if ($controllers->findByProductId() == 'OK')
        {
            $data = [
             'productid' => $args
             ];
            $controllers->findByProductId->stmt->execute($data);
            $result = $controllers->findByProductId->stmt->fetch(PDO::FETCH_OBJ);
            $resultCount = $controllers->findByProductId->stmt->rowCount();

            if ($resultCount > 0)
            {

                $this->productID = $result->product_ID;
                $this->name = $result->product_name;
                $this->description = $result->product_description;
                $this->type = $result->product_type;
                $this->category = $result->product_category;
                $this->status = $result->product_status;
                $this->price = $result->product_price;
                $this->quantity = $result->product_qty;
                $this->create_date = $result->product_create_date;
                $this->modify_date = $result->product_modify_date;
                $this->snapshot = $result->product_snapshot;

                return $this;
            }
            else
            {
                return 'No results returned';
            }

        }
        else{
            return $controllers->findByProductId();
        }

    }

    //function getByUserID($args, $status){
    //    global $controllers;
    //    global $_datetime;

    //    if ($controllers->findByProductId() == 'OK')
    //    {
    //        $data = [
    //         'productid' => $args
    //         ];
    //        $controllers->findByProductId->stmt->execute($data);
    //        $result = $controllers->findByProductId->stmt->fetch(PDO::FETCH_OBJ);
    //        $resultCount = $controllers->findByProductId->stmt->rowCount();

    //        if ($resultCount > 0)
    //        {
    //            $this->packageID = $result->idmtrix_entry;

    //            $this->productID = $result->product_ID;
    //            $this->name = $result->product_name;
    //            $this->description = $result->product_description;
    //            $this->type = $result->product_type;
    //            $this->category = $result->product_category;
    //            $this->status = $result->product_status;
    //            $this->price = $result->product_price;
    //            $this->quantity = $result->product_qty;
    //            $this->create_date = $result->product_create_date;
    //            $this->modify_date = $result->product_modify_date;
    //            $this->snapshot = $result->product_snapshot;

    //            return $this;
    //        }
    //        else
    //        {
    //            return 'No results returned';
    //        }

    //    }
    //    else{
    //        return $controllers->findByProductId();
    //    }

    //}

    function getAll(){

        global $controllers;
        if ($controllers->getAllProducts() == 'OK')
        {
            $controllers->getAllProducts->stmt->execute();
            $result = $controllers->getAllProducts->stmt->fetchAll(PDO::FETCH_OBJ);
            $resultCount = $controllers->getAllProducts->stmt->rowCount();

            if ($resultCount > 0)
            {
                $message_txt = 'Account found with ' . $resultCount . ' result(s)';
                $status = '200';

                //RETURN RESULT OBJECT
                return $result;

            }
            else
            {
                return '[]';
                $status = '500';
            }

        }
        else{
            $status = '301';
            return $controllers->getAllProducts();
        }


    }

    function checkRequirements($args){
       
        return true;
        
        //global $_datetime;
        //$wallet = new wallet;

        //$product_items = floatval($wallet->getWalletBalance($args->userID,$wallet->getWalletID('PRD_ITMS_TLT')));
        //$product_last_bought_date = $wallet->getWalletBalanceLastModified($args->userID,$wallet->getWalletID('PRD_ITMS_TLT'));
        //$product_last_bought_date = date('m',strtotime($product_last_bought_date));
        //$dateNow = date('m',strtotime($_datetime));

        //if ($product_items >= 2 and $product_last_bought_date == $dateNow)
        //{
        //    return true;
        //}
        //else{
        //    return false;
        //}


    }

    function newTx($args){

        global $controllers;
        global $_datetime;

        if ($controllers->newProductTx() == 'OK')
        {
            $data = [
             'product_ID' => $args->productID,
             'tx_type' =>  $args->txType,
             'tx_from' => $args->from,
             'tx_to' => $args->to,
             'tx_code_used' => $args->codeUsed,
             'tx_status' => $args->status,
             'tx_amount' => $args->amount,
             'tx_cost' => $args->cost,
             ];

            if ($controllers->newProductTx->stmt->execute($data))
            {
                return '200';
            }
            else
            {
                return '500';
            }

        }
        else{
            return $controllers->newProductTx();
        }



    }

    function setProductBalance($productID,$amount){
        global $controllers;
        global $_datetime;

        if ($controllers->set_product_balance() == 'OK')
        {
            $data = [
             'product_ID' => $productID,
             'amount' => $amount
             ];

            if ($controllers->set_product_balance->stmt->execute($data))
            {
                return '200';
            }
            else
            {
                return '500';
            }

        }
        else{
            return $controllers->set_product_balance();
        }
    }

    function topUpProductBalance($productID,$amount){
        global $controllers;
        global $_datetime;

        if ($controllers->productTopUp() == 'OK')
        {
            $data = [
             'product_ID' => $productID,
             'amount' => $amount
             ];

            if ($controllers->productTopUp->stmt->execute($data))
            {
                return '200';
            }
            else
            {
                return '500';
            }

        }
        else{
            return $controllers->productTopUp();
        }
    }

    function send($productID,$amount,$from,$to){
        global $_datetime;
        $wallet = new wallet;

        if ($from != "ADMIN")
        {
            if (floatval($wallet->getWalletBalance($from,$wallet->getWalletID('PRD_ITMS_UN'))) >= floatval($amount))
            {
                $wallet->topUp($to,$amount,$wallet->getWalletID('PRD_ITMS_UN'));
                $wallet->setBalance($from, (floatval($wallet->getWalletBalance($from,$wallet->getWalletID('PRD_ITMS_UN'))) - floatval($amount)),$wallet->getWalletID('PRD_ITMS_UN'));

                $this->getByProductID($productID);

                $settings = new stdClass;
                $settings->productID = $productID;
                $settings->txType = 'TRANSFER';
                $settings->from = $this->description;
                $settings->to = $this->price;
                $settings->codeUsed = '';
                $settings->status = 1;
                $settings->amount = $amount;
                $settings->cost = '';

                $this->newTx($settings);


                return '200';
            }
            else{
                return '500';
            }

        }
        else{
            $this->getByProductID($productID);
            if ($this->quantity >= $amount)
            {
                $this->setProductBalance($productID, floatval($this->quantity) - floatval($amount));
                $wallet->topUp($to,$amount,$wallet->getWalletID('PRD_ITMS_UN'));

                return '200';
            }
            else{
                return '500';
            }
        }

    }

    function consume($productID,$amount,$userID){
        global $_datetime;
        $wallet = new wallet;

        $wallet->topUp($userID,$amount,$wallet->getWalletID('PRD_ITMS_TLT'));
        $wallet->topUp($userID,$amount,$wallet->getWalletID('PRD_ITMS'));

        $prevBal = floatval($wallet->getWalletBalance($userID,$wallet->getWalletID('PRD_ITMS_UN')));

        if ($prevBal < floatval($amount))
        {
            $prevBal = $amount;
       //     $wallet->setBalance($userID, ($prevBal - floatval($amount)),$wallet->getWalletID('PRD_ITMS'));
        }


        $wallet->setBalance($userID, ($prevBal - floatval($amount)),$wallet->getWalletID('PRD_ITMS_UN'));


    }

}


?>