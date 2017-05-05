<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'database/dbOperation.php';
class FetchAvailabilityOrganiser {
    
    private $serviceId,$dbOperationObj;
    
    function __construct() {
        $this->dbOperationObj=new dboperation();
    }
    function testInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
    }
    
    function setServiceId()
    {
        $this->serviceId= $this->testInput($_GET['serviceId']);
    }
    
    function fetchAvailabilityOrganiser(){
        
       return $this->dbOperationObj->fetchAvailabilityOrganiser($this->serviceId);
    }
    
}
if(isset($_GET['serviceId'])){
$fetchAvailabilityOraganiserObj = new FetchAvailabilityOrganiser();
$fetchAvailabilityOraganiserObj->setServiceId();
echo json_encode($fetchAvailabilityOraganiserObj->fetchAvailabilityOrganiser());
}