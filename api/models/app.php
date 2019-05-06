<?php
class app{
    function __construct(){
        $this->appSystemUID = '';
        $this->appSystemName = 'D Herbs Ph';
        $this->appSimpleName = 'dherbsph';
        $this->appRuntimeElevation = 1;
        $this->appSecureEnv = true;
        $this->status = 1;
    }

    function GenerateNewUID(){
        $tmpUID =  generateRandomString(8) . '-' . generateRandomString(4) . '-' . generateRandomString(6);
        $tmpUID = strtoupper($tmpUID);
        return $tmpUID;
    }

}

?>