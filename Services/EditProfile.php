<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once '../database/DatabaseConnection.php';
require_once '../database/dbOperation.php';

class EditProfile {
    
    private $fullName,$address,$mobileNo,$userId, $servicesId,$dbOperationObj,$leavingServicesId;
    
    function __construct() {
        $this->dbOperationObj = new dboperation();
    }
    function testInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
    }
    
    function setFullName()
    {
        $this->fullName= $this->testInput($_POST['fullName']);
    }
    
    function setAddress()
    {
        $this->address= $this->testInput($_POST['address']);
    }
    
    function setMobileNo()
    {
        $this->mobileNo= $this->testInput($_POST['mobileNo']);
    }
    function setUserId()
    {
        $this->userId= $this->testInput($_POST['userId']);
    }
    function setServicesId()
    {
        $this->servicesId= $this->testInput($_POST['servicesId']);
    }
    function setLeavingServicesId(){
        $this->leavingServicesId = $this->testInput($_POST['leavingServicesId']);
    }
            
    function getUserId(){
        return $this->userId;
    }
    
    function getServicesId() {
        
        return $this->servicesId;
    }
    
    function getLeavingServicesId(){
        return $this->leavingServicesId;
    }
    
    function inserToDatabase() {
    
    $this->dbOperationObj->edtProfile($this->userId, $this->fullName, $this->address, $this->mobileNo);
    }
    
    function removePreviousServices() {
        
    $this->dbOperationObj->removePreviousServices($this->userId);
    }
    
    
}
if(isset($_POST['fullName'])){
$editProfile = new EditProfile();
$editProfile->setFullName();
$editProfile->setAddress();
$editProfile->setMobileNo();
$editProfile->setUserId();
$editProfile->setServicesId();
$editProfile->setLeavingServicesId();

$editProfile->inserToDatabase();


$connection=new DatabaseConnection();


$leavingServicesId=explode(',',$editProfile->getLeavingServicesId());
  foreach($leavingServicesId as $sId){
    
    $query= "call deleteServicesProviding(?,?)";
    $stmt=$connection->prepare($query);
    $stmt->bind_param("ii", $editProfile->getUserId(),$sId);
    $stmt->execute();
       $result = $stmt->get_result();
        $i=0;
        while($row=$result->fetch_assoc()) {
           $serviceAvailabilityId = $row['id'];
            $stmt->close();
           $query= "call deleteAvailImag(?)";
            $stmt=$connection->prepare($query);
            $stmt->bind_param("i", $serviceAvailabilityId);
            $stmt->execute();
            $i++;
        }
        $stmt->close();
  }

  $editProfile->removePreviousServices();
  
  $servicesId=explode(',',$editProfile->getServicesId());
  foreach($servicesId as $sId){
       $stmt->close();
    $query= "call updateServicesProviding(?,?)";
    $stmt=$connection->prepare($query);
    $stmt->bind_param("ii", $editProfile->getUserId(),$sId);
    $stmt->execute();
  }
  
  
}

