<?php
require_once("../app/model/coursModel.php");
if (isset($_REQUEST["page"])) {
    $page = $_REQUEST["page"];
    NotReturn();
    switch ($page) {
        case 'mesCours':
           coursProfesseur();
            break;
        
        default:
            # code...
            break;
    }}

    function coursProfesseur(){
       $cours=coursProf($_SESSION['user']["id"]);
       renderView('professeur','mesCours',['cours'=>$cours],'baselayout');
    }
