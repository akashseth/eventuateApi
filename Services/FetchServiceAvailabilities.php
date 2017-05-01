<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once '../database/dbOperation.php';
class FetchServiceAvailabilities {
    
    private $serviceProviderId, $serviceId,$dbOperationObj;
    
    function __construct() {
        $this->dbOperationObj=new dboperation();
    }
    function testInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
    }
    
    function setServiceProviderId()
    {
        $this->serviceProviderId= $this->testInput($_GET['serviceProviderId']);
    }
    
    function setServiceId()
    {
        $this->serviceId= $this->testInput($_GET['serviceId']);
    }
    
    function fetchServiceAvailabilitiesList(){
        
       return $this->dbOperationObj->fetchServiceAvailabilitiesList($this->serviceProviderId,$this->serviceId);
    }
    
}
if(isset($_GET['serviceId']) && isset($_GET['serviceProviderId'])){
$fetchServiceAvailabilitiesObj = new FetchServiceAvailabilities();
$fetchServiceAvailabilitiesObj->setServiceProviderId();
$fetchServiceAvailabilitiesObj->setServiceId();
echo json_encode($fetchServiceAvailabilitiesObj->fetchServiceAvailabilitiesList());
}