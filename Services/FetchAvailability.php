<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once '../database/dbOperation.php';
class FetchAvailability {
    
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
    
    function fetchAvailability(){
        
       return $this->dbOperationObj->fetchAvailability($this->serviceId);
    }
    
}
if(isset($_GET['serviceId'])){
$fetchAvailabilityObj = new FetchAvailability();
$fetchAvailabilityObj->setServiceId();
echo json_encode($fetchAvailabilityObj->fetchAvailability());
}