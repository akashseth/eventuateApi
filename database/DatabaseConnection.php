<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'databaseInfo.php';
class DatabaseConnection extends mysqli implements databaseInfo {
    
    function __construct() {
        parent::__construct(databaseInfo::serverName,databaseInfo::username,databaseInfo::password,databaseInfo::databaseName);
    }
    function __destruct() {
        parent::close();
    }
}