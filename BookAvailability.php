<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'database/dbOperation.php';
class BookAvailability {
    
    private $serviceProviderId,$serviceAvailabilityId,$dbOperationObj;
    private $amountPaid,$amountDue,$emailId,$quantity,$paymentMethod,$budgetLeft,$eventBudget;
    
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
    
    function setServiceProvicerId()
    {
        $this->serviceProviderId= $this->testInput($_POST['serviceProviderId']);
    }
    function setAmountPaid()
    {
        $this->amountPaid= $this->testInput($_POST['amountPaid']);
    }
    function setAmountDue()
    {
        $this->amountDue= $this->testInput($_POST['amountDue']);
    }
    function setEmailId()
    {
        $this->emailId= $this->testInput($_POST['emailId']);
    }
    function setQuantity()
    {
        $this->quantity= $this->testInput($_POST['quantity']);
    }
    function setPaymentMethod()
    {
        $this->paymentMethod= $this->testInput($_POST['paymentMethod']);
    }
    
    function setEventBudget()
    {
        $this->eventBudget= $this->testInput($_POST['eventBudget']);
    }
    function setBudgetLeft()
    {
        $this->budgetLeft= $this->testInput($_POST['budgetLeft']);
    }
    
    
    function submitBookingDetails(){
        $quantityAvailable = $this->dbOperationObj->getAvailabilityQuanitityWhileBooking(
                $this->serviceAvailabilityId, $this->emailId)['quantity_available'];
        
        if($quantityAvailable >= $this->quantity) {
            
            $this->dbOperationObj->bookAvailability($this->amountPaid, $this->amountDue, 
                    $this->emailId, $this->serviceProviderId, $this->serviceAvailabilityId, 
                    $this->quantity, $this->paymentMethod,$this->eventBudget,$this->budgetLeft);
            
            $to = $this->dbOperationObj->getServiceProviderEmailId($this->serviceProviderId)['EMAIL_ID'];
                $subject = 'New Order';
                $message = 'You have new order open app and check in View bookings'; 
              
                // Sending email
                mail($to, $subject, $message);
            echo json_encode(array("quantityAvailable"=>($quantityAvailable - $this->quantity),"result"=>1));
        }
        else {
            
            echo json_encode(array("quantityAvailable"=>$quantityAvailable,"result"=>0));
        }
    }
    
}
if(isset($_POST['serviceAvailabilityId']) && isset($_POST['serviceProviderId']) && isset($_POST['quantity']) && isset($_POST['paymentMethod'])){
$bookAvailabilityObj = new BookAvailability();
$bookAvailabilityObj->setAmountPaid();
$bookAvailabilityObj->setAmountDue();
$bookAvailabilityObj->setServiceAvailabilityId();
$bookAvailabilityObj->setServiceProvicerId();
$bookAvailabilityObj->setEmailId();
$bookAvailabilityObj->setQuantity();
$bookAvailabilityObj->setPaymentMethod();
$bookAvailabilityObj->setEventBudget();
$bookAvailabilityObj->setBudgetLeft();
$bookAvailabilityObj->submitBookingDetails();

}
else {
    
    echo json_encode(array("result"=>"2"));
}