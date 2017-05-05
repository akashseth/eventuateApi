<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once '../database/dbOperation.php';
class UpdatePriceQuantity {
    
    private $serviceAvailabilityId,$price,$quantity,$dbOperationObj;
    
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
    function setQuantity()
    {
        $this->quantity= $this->testInput($_POST['quantity']);
    }
    
    function updatePriceQuantity(){
        $this->dbOperationObj->updatePriceQuantity($this->serviceAvailabilityId, $this->price,$this->quantity);
    }
    
}
if(isset($_POST['serviceAvailabilityId']) && $_POST['price']){
$updatePriceObj = new UpdatePriceQuantity();
$updatePriceObj->setServiceAvailabilityId();
$updatePriceObj->setPrice();
$updatePriceObj->setQuantity();
$updatePriceObj->updatePriceQuantity();
echo 1;
}
else {
    
    echo 0;
}