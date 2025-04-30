<?php
require_once("../app/model/etudiantModel.php");
require_once("../config/helpers.php");

if (isset($_REQUEST["page"])) {
    $page = $_REQUEST["page"];
    NotReturn();
    if ($page == 'coursEtudiant') {
        mesCours();
    } elseif ($page=='absenceEtudiant') {
        mesAbsences();
        justifier();

    } elseif ($page =='formJustify') {
        // justifier();
    } elseif ($page =='justifyAbsence') {
        mesJustifications();
    }  elseif ($page =='essai') {
        $cours=findCoursByDate($_GET["filtre_date"],1);
        require_once("../app/views/etudiant/essai.php");
    } elseif ($page =='essaie') {
        $cours=findCoursByDate($_GET["filtre_date"],1);
        require_once("../app/views/etudiant/essaie.php");
    }
} else{
    mesCours();
}



function mesCours()  {
    ob_start();
    $etudiant=infoEtudiant($_SESSION['user']["id"]);
    $cours =coursEtudiant($_SESSION['user']["id"]);
    if (isset($_GET["filtre_date"])){
        $cours=findCoursByDate($_GET["filtre_date"],$_SESSION['user']["id"]);
    }
    require_once("../app/views/etudiant/coursEtudiant.php");
    $contenu= ob_get_clean();
    require_once("../app/views/layout/baselayout.php");
}

function mesAbsences()  {
    ob_start();
    $absence=absenceEtudiant($_SESSION['user']["id"]);
    if (isset($_GET["etat"])){
        $absence=findAbsenceByetat($_GET["etat"],$_SESSION['user']["id"]);
    }
    require_once("../app/views/etudiant/absenceEtudiant.php");
    $contenu= ob_get_clean();
    require_once("../app/views/layout/baselayout.php");
}

function mesJustifications() {
    ob_start();
    $justifications=justifyAbsence($_SESSION['user']["id"]);
    if (isset($_GET["statut"])){
        $justifications=findJustifyByStatut($_GET["statut"],$_SESSION['user']["id"]);
    }
    require_once("../app/views/etudiant/justifyAbsence.php");
    $contenu= ob_get_clean();
    require_once("../app/views/layout/baselayout.php");
}

function justifier()  {
    ob_start();
    if (isset($_POST["addjustify"])) {
        $justify=ajoutJustification($_GET["absence-id"],$_POST["motif"]);
    }
    require_once("../app/views/etudiant/absenceEtudiant.php");
    $contenu= ob_get_clean();
    require_once("../app/views/layout/baselayout.php");
}