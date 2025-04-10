<?php
require_once("../app/model/etudiantModel.php");
if (isset($_REQUEST["page"])) {
    $page = $_REQUEST["page"];

    if ($page == 'coursEtudiant') {
        mesCours();
    } elseif ($page=='absenceEtudiant') {
        mesAbsences();
    } elseif ($page =='formJustify') {
        justifier();
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
    $etudiant=infoEtudiant();
    $cours =coursEtudiant();
    if (isset($_GET["filtre_date"])){
        $cours=findCoursByDate($_GET["filtre_date"],1);
    }
    require_once("../app/views/etudiant/coursEtudiant.php");
    $contenu= ob_get_clean();
    require_once("../app/views/layout/baselayout.php");
}

function mesAbsences()  {
    ob_start();
    $absence=absenceEtudiant();
    if (isset($_GET["etat"])){
        $absence=findAbsenceByetat($_GET["etat"],1);
    }
    require_once("../app/views/etudiant/absenceEtudiant.php");
    $contenu= ob_get_clean();
    require_once("../app/views/layout/baselayout.php");
}

function mesJustifications() {
    ob_start();
    $justifications=justifyAbsence();
    if (isset($_GET["statut"])){
        $justifications=findJustifyByStatut($_GET["statut"],1);
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
    require_once("../app/views/etudiant/formJustify.php");
    $contenu= ob_get_clean();
    require_once("../app/views/layout/baselayout.php");
}