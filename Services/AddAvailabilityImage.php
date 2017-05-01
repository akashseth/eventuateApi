<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once '../database/dbOperation.php';
class AddAvailability {
    
    private $serviceAvailabilityId,$dbOperationObj;
    public $imageName,$base64;
            
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
    
    function setImageName()
    {
        $this->imageName= $this->testInput($_POST['imageName']);
    }
    
    function setBase64() {
        $this->base64 = $_POST['base64'];
    }
     function saveImagePath(){
        $this->dbOperationObj->saveImagePath($this->serviceAvailabilityId, $this->imageName);
        //echo $this->serviceProviderId, $this->availabilityId, $this->imageName;
    }
    
}
if(isset($_POST['serviceAvailabilityId']) && isset($_POST['base64']) && isset($_POST['imageName']) ){
$addAvailabilityObj = new AddAvailability();
$addAvailabilityObj->setServiceAvailabilityId();
$addAvailabilityObj->setImageName();
$addAvailabilityObj->setBase64();

$imgTest = $addAvailabilityObj->base64;

   if($imgTest != "null") {
        
    $imgPath = "../availabilityImages/".$addAvailabilityObj->imageName;
    $imgBase64 = str_replace(' ','+',$imgTest);
    $imgBase64 = base64_decode($imgBase64);
    $fp = fopen($imgPath, 'w');
    fwrite($fp, $imgBase64);
    
    if(fclose($fp) ){
            
            $addAvailabilityObj->saveImagePath();
            echo 1;
           
    }else{
           echo 0;
        }
  }
 else {
       echo 0;
   }
      
}
else {
    
    echo 0;
}