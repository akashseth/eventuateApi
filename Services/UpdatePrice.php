<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once '../database/dbOperation.php';
class UpdatePrice {
    
    private $serviceAvailabilityId,$price,$dbOperationObj;
    
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
    
    function setPrice()
    {
        $this->price= $this->testInput($_POST['price']);
    }
    
    function updatePrice(){
        $this->dbOperationObj->updatePrice($this->serviceAvailabilityId, $this->price);
    }
    
}
if(isset($_POST['serviceAvailabilityId']) && $_POST['price']){
$updatePriceObj = new UpdatePrice();
$updatePriceObj->setServiceAvailabilityId();
$updatePriceObj->setPrice();
$updatePriceObj->updatePrice();
echo 1;
}
else {
    
    echo 0;
}