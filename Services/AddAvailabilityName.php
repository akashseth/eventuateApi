<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once '../database/dbOperation.php';
class AddAvailability {
    
    private $serviceId,$availabilityName,$dbOperationObj;
    
    function __construct() {
        $this->dbOperationObj=new dboperation();
    }
    function testInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
    }
    
    function setAvailabilityName()
    {
        $this->availabilityName= $this->testInput($_POST['availabilityName']);
    }
    
    function setServiceId()
    {
        $this->serviceId= $this->testInput($_POST['serviceId']);
    }
    
    function addAvailabilityName(){
        $this->dbOperationObj->addAvailabilityName($this->serviceId, $this->availabilityName);
    }
    
}
if(isset($_POST['availabilityName']) && $_POST['serviceId']){
$addAvailabilityObj = new AddAvailability();
$addAvailabilityObj->setAvailabilityName();
$addAvailabilityObj->setServiceId();
$addAvailabilityObj->addAvailabilityName();
echo 1;
}
else {
    
    echo 0;
}