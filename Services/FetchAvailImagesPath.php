<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once '../database/dbOperation.php';
class FetchAvailImagesPath {
    
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
        $this->serviceAvailabilityId= $this->testInput($_GET['serviceAvailabilityId']);
    }
    
    function fetchServiceAvailabilityImagePaths(){
        
       return $this->dbOperationObj->fetchServiceAvailabilityImagePaths($this->serviceAvailabilityId);
    }
    
}
if(isset($_GET['serviceAvailabilityId'])){
   // echo'1';
$fetchAvailImagesPathObj = new FetchAvailImagesPath();
$fetchAvailImagesPathObj->setServiceAvailabilityId();
echo json_encode($fetchAvailImagesPathObj->fetchServiceAvailabilityImagePaths());
}