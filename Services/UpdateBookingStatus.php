<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once '../database/dbOperation.php';
class UpdateBookingStatus {
    
    private $bookingId,$bookingStatus,$organiserEmail,$dbOperationObj;
    
    function __construct() {
        $this->dbOperationObj=new dboperation();
    }
    function testInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
    }
    
    function setBookingId()
    {
        $this->bookingId= $this->testInput($_POST['bookingId']);
    }
    
    function setBookingStatus()
    {
        $this->bookingStatus= $this->testInput($_POST['bookingStatus']);
    }
    function setOrganiserEmail(){
        
        $this->organiserEmail = $this->testInput($_POST['organiserEmail']);
    }
            
    function updateBookingStatus(){
       
        $this->dbOperationObj->updateBookingStatus($this->bookingStatus, $this->bookingId);
        $to = $this->organiserEmail;
        $subject = 'Order Status | '.$this->bookingStatus;
        $message = 'Your order has been '.$this->bookingStatus.' by service provider.'; 

        // Sending email
        mail($to, $subject, $message);
    }
    
}
if(isset($_POST['bookingId']) && isset($_POST['bookingStatus'])){
$updateBookingStatusObj = new UpdateBookingStatus();
$updateBookingStatusObj->setBookingId();
$updateBookingStatusObj->setBookingStatus();
$updateBookingStatusObj->setOrganiserEmail();
$updateBookingStatusObj->updateBookingStatus();
echo 1;
}
else {
    
    echo 0;
}