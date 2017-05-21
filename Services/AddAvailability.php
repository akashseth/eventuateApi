<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once '../database/dbOperation.php';
class AddAvailability {
    
    private $serviceProviderId,$serviceId,$availabilityName,$price,$quantity,$dbOperationObj;
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
    
    function setServiceProviderId()
    {
        $this->serviceProviderId = $this->testInput($_POST['serviceProviderId']);
    }
    
    function setAvailabilityName()
    {
        $this->availabilityName= $this->testInput($_POST['availabilityName']);
    }
    
    function setPrice()
    {
        $this->price= $this->testInput($_POST['price']);
    }
    function setImageName()
    {
        $this->imageName= $this->testInput($_POST['imageName']);
    }
    function setImageNameNone($none)
    {
        $this->imageName = $none;
    }
    
    function setServiceId()
    {
        $this->serviceId= $this->testInput($_POST['serviceId']);
    }
     function setQuantity()
    {
        $this->quantity= $this->testInput($_POST['quantity']);
    }
    
    function addAvailability(){
        $this->dbOperationObj->addAvailability($this->serviceProviderId,$this->serviceId, $this->availabilityName,$this->price,  $this->imageName, $this->quantity);
    }
    function setBase64() {
        $this->base64 = $_POST['base64'];
    }
    
}
if(isset($_POST['availabilityName']) && isset($_POST['serviceId']) && isset($_POST['quantity']) && isset($_POST['price']) ){
$addAvailabilityObj = new AddAvailability();
$addAvailabilityObj->setServiceProviderId();
$addAvailabilityObj->setAvailabilityName();
$addAvailabilityObj->setServiceId();
$addAvailabilityObj->setPrice();
$addAvailabilityObj->setImageName();
$addAvailabilityObj->setBase64();
$addAvailabilityObj->setQuantity();

$imgTest = $addAvailabilityObj->base64;

   if($imgTest != "null") {
        
    $imgPath = "../availabilityImages/".$addAvailabilityObj->imageName;
    $imgBase64 = str_replace(' ','+',$imgTest);
    $imgBase64 = base64_decode($imgBase64);
    $fp = fopen($imgPath, 'w');
    fwrite($fp, $imgBase64);
    
    if(fclose($fp) ){
           // echo "Image uploaded";
           
    }else{
           $addAvailabilityObj->setImageNameNone("none");
            echo "Error uploading image";
        }
   }
   else {
       $addAvailabilityObj->setImageNameNone("none");
   }
    $addAvailabilityObj->addAvailability();
echo 1;
}
else {
    
    echo 0;
}