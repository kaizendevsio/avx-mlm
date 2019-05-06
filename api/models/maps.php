<?php
error_reporting(0);
class maps{
    function __construct(){
        $this->Name = 'Binary' ;
        $this->type = '';
        $this->account_code = '';
        $this->maps_left_account_code = '';
        $this->maps_right_account_code = '';
        $this->maps_created_timestamp = '';
        $this->maps_modify_timestamp = '';
    }

    function CreateBinaryNode($options){
        global $controllers;
        global $_datetime;

        if ($controllers->newMapsBinaryNode() == 'OK')
        {
            $data = [
             'account_code' => $options->account_code
             ];

            if ($controllers->newMapsBinaryNode->stmt->execute($data))
            {
                return '200';
            }
            else
            {
                return '500';
            }

        }
        else{
            return $controllers->newMapsBinaryNode();
        }
    }

    function FindByAccountCode($options){
        global $controllers;
        global $_datetime;

        if ($controllers->findByMapsUserId() == 'OK')
        {
            $data = [
             'account_code' => $options->account_code
             ];

            $controllers->findByMapsUserId->stmt->execute($data);
            $result = $controllers->findByMapsUserId->stmt->fetch(PDO::FETCH_OBJ);
            $resultCount = $controllers->findByMapsUserId->stmt->rowCount();

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
            return $controllers->findByMapsUserId();
        }
    }

    function AttachNodeToLeft($node1,$node2){
        global $controllers;
        global $_datetime;

        if ($controllers->setMapsAttachLeft() == 'OK')
        {
            $data = [
             'account_code' => $node1->account_code,
             'maps_left_account_code' => $node2
             ];

            if ($controllers->setMapsAttachLeft->stmt->execute($data))
            {
                return '200';
            }
            else
            {
                return '500';
            }

        }
        else{
            return $controllers->setMapsAttachLeft();
        }
    }

    function AttachNodeToRight($node1,$node2){
        global $controllers;
        global $_datetime;

        if ($controllers->setMapsAttachRight() == 'OK')
        {
            $data = [
             'account_code' => $node1->account_code,
             'maps_right_account_code' => $node2
             ];

            if ($controllers->setMapsAttachRight->stmt->execute($data))
            {
                return '200';
            }
            else
            {
                return '500';
            }

        }
        else{
            return $controllers->setMapsAttachRight();
        }
    }

    function GetMapDisplay($options, $parentNode = null){
        $accounts = new accounts;

        $MapStructureCollection = [];

        // INITIALIZE PARENT NODE

        $tmpMainNode = $this->FindByAccountCode($options);
        $currentUser = $accounts->findById($options->account_code);

        $MapStructure = new MapStructure;
        $MapStructure->id = $tmpMainNode->account_code;
        $MapStructure->name = $currentUser->userName;
        $MapStructure->pid = $parentNode->account_code;

        array_push($MapStructureCollection,$MapStructure);

        // INITIALIZE LEFT NODE
        $currentUser = $accounts->findById($tmpMainNode->maps_left_account_code);
        $tmpNode = $this->FindByAccountCode($currentUser);

        if ($tmpNode != 'No results returned')
        {
            $MapStructure = new MapStructure;
            $MapStructure->id = $tmpNode->account_code;
            $MapStructure->pid = $tmpMainNode->account_code;
            $MapStructure->name = $currentUser->userName;

           // array_push($MapStructureCollection,$MapStructure);

            $ExternalMapStructureCollection = $this->GetMapDisplay($currentUser,$tmpMainNode);
            $CollectionCount = count($ExternalMapStructureCollection);

            for ($i = 0; $i < $CollectionCount; $i++)
            {
                array_push($MapStructureCollection,$ExternalMapStructureCollection[$i]);
            }

        }


        // INITIALIZE RIGHT NODE
        $currentUser = $accounts->findById($tmpMainNode->maps_right_account_code);
        $tmpNode = $this->FindByAccountCode($currentUser);

        if ($tmpNode != 'No results returned')
        {
            $MapStructure = new MapStructure;
            $MapStructure->id = $tmpNode->account_code;
            $MapStructure->pid = $tmpMainNode->account_code;
            $MapStructure->name = $currentUser->userName;

            //array_push($MapStructureCollection,$MapStructure);

            $ExternalMapStructureCollection = $this->GetMapDisplay($currentUser,$tmpMainNode);
            $CollectionCount = count($ExternalMapStructureCollection);

            for ($i = 0; $i < $CollectionCount; $i++)
            {
                array_push($MapStructureCollection,$ExternalMapStructureCollection[$i]);
            }
        }

        return $MapStructureCollection;
    }



}

class MapStructure{
    function __construct(){
        $this->id = '';
        $this->pid = '';
        $this->name = '';
    }
}


?>