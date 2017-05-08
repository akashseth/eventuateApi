<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once '../database/dbOperation.php';
class FetchProfile{
    
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
        $this->serviceProviderId= $this->testInput($_GET['serviceProviderId']);
    }
    
    function fetchProfile(){
        
       return $this->dbOperationObj->fetchProfileServices($this->serviceProviderId);
    }
    
}
if(isset($_GET['serviceProviderId'])){
$fetchProfileObj = new FetchProfile();
$fetchProfileObj->setServiceProviderId();
echo json_encode($fetchProfileObj->fetchProfile());
}