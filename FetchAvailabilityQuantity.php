<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'database/dbOperation.php';
class FetchAvailabilityQuantity{
    
    private $serviceAvailabilityId,$email,$dbOperationObj;
    
    function __construct() {
        $this->dbOperationObj=new dboperation();
    }
    function testInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
    }
    
    function setServiceAvailabilityId()
    {
        $this->serviceAvailabilityId= $this->testInput($_GET['serviceAvailabilityId']);
    }
    function setEmailId()
    {
        $this->email= $this->testInput($_GET['emailId']);
    }
    
    function fetchAvailabilityQuantity(){
        
       return $this->dbOperationObj->getAvailabilityQuanitityWhileBooking($this->serviceAvailabilityId,$this->email);
    }
    
}
if(isset($_GET['serviceAvailabilityId']) && isset($_GET['emailId'])){
$fetchAvailabilityQuantityObj = new FetchAvailabilityQuantity();
$fetchAvailabilityQuantityObj->setServiceAvailabilityId();
$fetchAvailabilityQuantityObj->setEmailId();
echo json_encode($fetchAvailabilityQuantityObj->fetchAvailabilityQuantity());
}