<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once '../database/dbOperation.php';
class DeleteServiceAvailability {
    
    private $serviceAvailabilityId,$dbOperationObj;
    
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
        $this->serviceAvailabilityId= $this->testInput($_POST['serviceAvailabilityId']);
    }
    
    function deleteServiceAvailability(){
        $this->dbOperationObj->deleteServiceAvailability($this->serviceAvailabilityId);
    }
    
}
if(isset($_POST['serviceAvailabilityId'])){
$deleteServiceAvailability = new DeleteServiceAvailability();
$deleteServiceAvailability->setServiceAvailabilityId();
$deleteServiceAvailability->deleteServiceAvailability();
echo 1;
}
else {
    
    echo 0;
}