<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

require_once 'DatabaseConnection.php';
class dboperation {
    //put your code here
    private $connectionObj, $stmt, $rows;
    
    function __construct() {
        $this->connectionObj=new DatabaseConnection();
    }
    
    function getResultantRow() {
        
        $result = $this->stmt->get_result();
        return $result->fetch_assoc();
    }
            
    function getMultipleResultantRows(){
        
        $result = $this->stmt->get_result();
        $i=0;
        while($row=$result->fetch_assoc()) {
            $this->rows[$i] = $row;
            $i++;
        }
        //print_r($rows);
        return $this->rows;
    }
    
    function edtProfile($userId,$fullName,$address,$mobileNo) {
        
        $query = "call editProfile(?,?,?,?)";
        $stmt=$this->connectionObj->prepare($query);
        $stmt->bind_param('ssss',$userId,$fullName,$address,$mobileNo);
        $stmt->execute();
        
    }
    function removePreviousServices($userId) {
        
        $query="call removePreviousServices(?)";
        $stmt=$this->connectionObj->prepare($query);
        $stmt->bind_param('i', $userId);
        $stmt->execute();
    }
    function addAvailabilityName($serviceId,$availabiltyName) {
        
        $query="call addAvailabilityName(?,?)";
        $stmt=$this->connectionObj->prepare($query);
        $stmt->bind_param('is', $serviceId,$availabiltyName);
        $stmt->execute();
    }
    
    function fetchAvailability($serviceId) {
        
        $query="call fetchAvailability(?)";
        $this->stmt=$this->connectionObj->prepare($query);
        $this->stmt->bind_param('i', $serviceId);
        $this->stmt->execute();
        return $this->getMultipleResultantRows();
    }
    function addAvailability($serviceProviderId,$serviceId,$availabilityName,$price,$imageName,$quantity) {
        
        $query="call addAvailability(?,?,?,?,?)";
        $this->stmt=$this->connectionObj->prepare($query);
        $this->stmt->bind_param('iisii', $serviceProviderId,$serviceId,$availabilityName,$price,$quantity);
        $this->stmt->execute();
        $row = $this->getResultantRow();
        $serviceAvailabilityId = $row['id'];
        
        $this->stmt->close();
        $this->saveImagePath($serviceAvailabilityId, $imageName);
        
    }
     function saveImagePath($serviceAvailabilityId,$imageName) {
        
        $query="call saveImagePath(?,?)";
        $stmt=$this->connectionObj->prepare($query);
        $stmt->bind_param('is', $serviceAvailabilityId,$imageName);
        $stmt->execute();
    }
    
    function fetchServiceAvailabilitiesList($serviceProviderId,$serviceId) {
        
        $query="call fetchServiceAvailabilitiesList(?,?)";
        $this->stmt=$this->connectionObj->prepare($query);
        $this->stmt->bind_param('ii', $serviceProviderId,$serviceId);
        $this->stmt->execute();
        return $this->getMultipleResultantRows();
    }
    
     function updatePriceQuantity($serviceAvailabilityId,$price,$quantity) {
        
        $query="call updatePriceQuantity(?,?,?)";
        $stmt=$this->connectionObj->prepare($query);
        $stmt->bind_param('iii', $serviceAvailabilityId,$price,$quantity);
        $stmt->execute();
    }
    function deleteServiceAvailability($serviceAvailabilityId) {
        
        $query="call deleteServiceAvailability(?)";
        $stmt=$this->connectionObj->prepare($query);
        $stmt->bind_param('i', $serviceAvailabilityId);
        $stmt->execute();
    }
    function getImageNameAndDeleteImageEntry($imageId) {
        
        $query="call getImageNameAndDeleteImageEntry(?)";
        $this->stmt=$this->connectionObj->prepare($query);
        $this->stmt->bind_param('i', $imageId);
        $this->stmt->execute();
        return $this->getResultantRow();
    }
    function fetchServiceAvailabilityImagePaths($serviceAvailabilityId) {
        
        $query="call fetchServiceAvailabilityImagePaths(?)";
        $this->stmt=$this->connectionObj->prepare($query);
        $this->stmt->bind_param('i', $serviceAvailabilityId);
        $this->stmt->execute();
        return $this->getMultipleResultantRows();
    }
    
   function fetchAvailabilityOrganiser($serviceId) {
        
        $query="call fetchAvailabilityOrganiser(?)";
        $this->stmt=$this->connectionObj->prepare($query);
        $this->stmt->bind_param('i',$serviceId);
        $this->stmt->execute();
        return $this->getMultipleResultantRows();
    }
            
}