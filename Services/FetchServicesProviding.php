<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once '../database/dbOperation.php';
class FetchServicesProviding {
    
    private $serviceProviderId,$dbOperationObj;
    
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
        $this->serviceProviderId= $this->testInput($_GET['userId']);
    }
    
    function fetchServicesProviding(){
        
       return $this->dbOperationObj->fetchServicesProviding($this->serviceProviderId);
    }
    
}
if(isset($_GET['userId'])){
$fetchServicesProviding = new FetchServicesProviding();
$fetchServicesProviding->setServiceProviderId();
echo json_encode($fetchServicesProviding->fetchServicesProviding());
}