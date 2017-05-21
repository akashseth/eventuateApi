<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'database/dbOperation.php';
class FetchProfileOrg{
    
    private $emailId,$dbOperationObj;
    
    function __construct() {
        $this->dbOperationObj=new dboperation();
    }
    function testInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
    }
    
    function setEmailId()
    {
        $this->emailId= $this->testInput($_GET['emailId']);
    }
    
    function fetchProfile(){
        
       return $this->dbOperationObj->fetchProfileOrg($this->emailId);
    }
    
}
if(isset($_GET['emailId'])){
$fetchProfileObj = new FetchProfileOrg();
$fetchProfileObj->setEmailId();
echo json_encode($fetchProfileObj->fetchProfile());
}