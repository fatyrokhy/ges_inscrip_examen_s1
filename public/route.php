<?php
session_start();
require_once("../config/helpers.php");
require_once("../config/database.php");
define('PAGE','http://faty.niass.ecole221.sn:8000/?');
define('PATH', realpath(__DIR__ . '/../'));
function run()  {
    $mesControllers=[
        "etudiant" =>"../app/controller/etudiantController.php",
        "rpController"=>"../app/controller/rpController.php",
        "security"=>"../app/controller/loginController.php",
        "prof"=>"../app/controller/profController.php",
        "inscrit"=>"../app/controller/inscritController.php",
        "absence"=>"../app/controller/absenceController.php",
        "justify"=>"../app/controller/justifyController.php",
        "cours"=>"../app/controller/coursController.php"
    ];
    
    $controller=$_REQUEST["controller"]??"security";
        if (array_key_exists($controller,$mesControllers)) {
            if (isConnect() || $controller == "security") {
                require_once $mesControllers[$controller];
            }else {
                redirection("security", "connexion");
            }
        } else {
            echo "Ce controller ".  $controller .  " n'existe pas";
        }
       
    }
