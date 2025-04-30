<?php
require_once("../app/model/absenceModel.php");
if (isset($_REQUEST["page"])) {
    $page = $_REQUEST["page"];
    NotReturn();
    switch ($page) {
        case 'absence':
            absence();
            break;
        
        default:
            # code...
            break;
    }}

    function absence(){
       $absence=listeAbsence();
       renderView('attache','absence',['absence'=>$absence],'baselayout');
    }
