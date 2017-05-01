<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once '../database/dbOperation.php';
class DeleteImgAvail {
    
    private $imageId,$imageName,$dbOperationObj;
    
    function __construct() {
        $this->dbOperationObj=new dboperation();
    }
    function testInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
    }
    
    function setImageId()
    {
        $this->imageId= $this->testInput($_POST['imageId']);
    }
    
    function setImageName(){
        $this->imageName=$this->dbOperationObj->getImageNameAndDeleteImageEntry($this->imageId)['image_location'];
    }
    function deleteImageFromFolder(){
        $filename = "../availabilityImages/".$this->imageName;
        unlink($filename);
    }
    
}
if(isset($_POST['imageId'])){
$deleteImgAvail = new DeleteImgAvail();
$deleteImgAvail->setImageId();
$deleteImgAvail->setImageName();
$deleteImgAvail->deleteImageFromFolder();
echo 1;
}
else {
    
    echo 0;
}