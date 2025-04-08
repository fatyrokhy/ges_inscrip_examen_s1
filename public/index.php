<?php
session_start();
require_once("../config/database.php");
define('PAGE','http://faty.niass.ecole221.sn:8003/?');
if (isset($_REQUEST["controller"])) {
    $controller=$_REQUEST["controller"];
   if ($controller=="etudiantController") {
        require_once("../app/controller/etudiantController.php");
    } 
} else {
    require_once("../app/controller/etudiantController.php");
}