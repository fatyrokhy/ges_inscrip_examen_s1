<?php
require_once("../app/model/etudiantModel.php");
if (isset($_REQUEST["page"])) {
    $page = $_REQUEST["page"];

    if ($page == 'coursEtudiant') {
        ob_start();
        $cours =coursEtudiant();
        if (isset($_GET["semestre"])){
            $cours=findCoursBySemestre($_GET["semestre"]);

        }
        require_once("../app/views/etudiant/coursEtudiant.php");
        $contenu= ob_get_clean();
        require_once("../app/views/layout/baselayout.php");
    } elseif ($page=='absenceEtudiant') {
        ob_start();
        $absence=absenceEtudiant();
        require_once("../app/views/etudiant/absenceEtudiant.php");
        $contenu= ob_get_clean();
        require_once("../app/views/layout/baselayout.php");
    } elseif ($page =='formJustify') {
        ob_start();
        if (isset($_POST["addjustify"])) {
            $justify=ajoutJustification($_GET["absence-id"],$_POST["motif"]);
        }
        require_once("../app/views/etudiant/formJustify.php");
        $contenu= ob_get_clean();
        require_once("../app/views/layout/baselayout.php");
    } elseif ($page =='justifyAbsence') {
        ob_start();
        $justifications=justifyAbsence();
        require_once("../app/views/etudiant/justifyAbsence.php");
        $contenu= ob_get_clean();
        require_once("../app/views/layout/baselayout.php");
    }
}