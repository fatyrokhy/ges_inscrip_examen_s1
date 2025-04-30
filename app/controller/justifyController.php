<?php
require_once("../app/model/justifyModel.php");
if (isset($_REQUEST["page"])) {
    $page = $_REQUEST["page"];
    NotReturn();
    switch ($page) {
        case 'justify':
            justification();
            break;
        
        default:
            # code...
            break;
    }}

    function justification(){
       $justify=listeJustification();
       renderView('attache','justification',['justify'=>$justify],'baselayout');
    }
