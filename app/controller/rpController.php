<?php

require_once("../app/model/classeModel.php");
require_once("../app/model/coursModel.php");
require_once("../app/model/profModel.php");
require_once("../app/model/classeModel.php");
require_once("../config/helpers.php");

if (isset($_REQUEST["page"])) {
    $page = $_REQUEST["page"];
    NotReturn();
    // NotReturnConnexion('rpController','dashboardRp');
    if ($page == 'dashboardRp') {
        dashboard();

        } elseif ($page == 'classe') {
            classe();

        } elseif ($page == 'formClasse') {
            formClasse();

        }  elseif ($page == 'confirmArchive') {
            confirmArchive();

        } elseif ($page == 'voirEtudiantClasse') {
            voirEtudiantClasse() ;

        } elseif ($page == 'coursPlannifier') {
            coursPlannifier() ;

        } elseif ($page == 'formCours') {
            formCours() ;

        } elseif ($page == 'voirClasse') {
            voirClasse() ;

        } elseif ($page == 'annulerCours') {
            annuleCours() ;
            
        }
    }


function dashboard() {
    $totalClassActif=nbreTotal("classes","actif");
    $totalProfActif=nbreTotal("professeurs","actif");
    $totalProfArchiver=nbreTotal("professeurs","archiver");
    $dataCoursParClasse = courbeCoursParClasse();
    $dataCoursParProf =courbeCoursParProf();

    renderView('rp','dashboardRp',[ 'totalClassActif'=>$totalClassActif ,
     'totalProfActif'=>$totalProfActif , 'totalProfArchiver'=>$totalProfArchiver,
     'dataCoursParClasse'=>$dataCoursParClasse,'dataCoursParProf'=>$dataCoursParProf
    ],'baselayout');
}  

function classe(){
    $filiere=select("filieres");
    $niveau=select("niveaux");
    $classe=listeClasses("actif");
    if (isset($_GET["filtre_filiere"])|| isset($_GET["filtre_niveau"])) {
        $classe=findClassByFiliereOrNiveau("actif",$_GET["filtre_filiere"],$_GET["filtre_niveau"]);
    }
    renderView('rp','classe',[ 'filiere'=>$filiere , 'niveau'=>$niveau , 
      'classe'=>$classe  
    ],'baselayout');
}

function formClasse()  {
    ob_start();
   global $errors;
   $errors=[];
    $filieres=select("filieres");
    $niveaux=select("niveaux");
    if (isset($_POST["addClasse"])) {
        isEmpty("libelle", $errors);
        isEmpty("niveau", $errors);
        isEmpty("filiere", $errors);
        $libelle = trim($_POST["libelle"]);
        $niveau = trim($_POST["niveau"]);
        $filiere = trim($_POST["filiere"]);
    

        if (!isset($_GET["edit"])) {
            $classe = select("classes");
            foreach ($classe as $value) {
                if ($value["libelle"] == $libelle) {
                    $errors['erreur'] = "Cette classe existe déjà";
                }
            }
        }
        if ($errors == []) {
            if (isset($_GET["edit"])) {
                modifClasse($_GET["edit"], $libelle,$niveau , $filiere);
            } else {
                ajoutClasse($libelle, $niveau, $filiere);
            }
            header("Location: " . PAGE . "?controller=rpController&page=classe");
            exit();
        }
    }
    if (isset($_GET["edit"])) {
        $class = valueChamp($_GET["edit"]);
    } else {
        $class = [];
    }
    require_once("../app/views/rp/formClasse.php");
    $contenu= ob_get_clean();
    require_once("../app/views/layout/baselayout.php");

 
}

function confirmArchive(){
    ob_start();
    if (isset($_GET['action']) && $_GET['action'] == 'traiterArchive') {
        $id = $_GET['id'] ?? null;
        $choix = $_GET['choice'] ?? '';
        if ($choix === 'oui' && $id) {
            archiveClasse($id); 
        }

        header('Location: ' . PAGE . 'controller=rpController&page=classe');
    }
    renderView('rp','confirmArchive',[],'baselayout');
}
function voirEtudiantClasse() {
    ob_start();
    if (isset($_GET['voir'])) {
        $student=voirEtudiant($_GET['voir']);
        }
    require_once("../app/views/rp/voirEtudiantClasse.php");
    $contenu= ob_get_clean();
    require_once("../app/views/layout/baselayout.php");   
}

function coursPlannifier() {
    ob_start();
    $cours=listeCoursPlanifie('planifier','professeur');
    $classe=selectElement('classes','actif');
    if (isset($_GET["filtre_date"])) {
        $cours=findCoursByDate($_GET["filtre_date"],'planifier','professeur');
    }
    if (isset($_GET["prof"])) {
        $cours=findCoursByProf($_GET["prof"]);
    }
    require_once("../app/views/rp/coursPlannifier.php");
    $contenu= ob_get_clean();
    require_once("../app/views/layout/baselayout.php");   
  
}
function formCours() {
    ob_start();
    $errors=[];
    $module=select('modules');
    $prof=listeProf('actif','professeur');
    $classe=selectElement('classes','actif');
    if (isset($_POST["addCours"])) {
        $module=$_POST["module"];
        $prof=$_POST["prof"];
        $semestre=$_POST["semestre"];
        $date=$_POST["date"];
        $hd=$_POST["hd"];
        $hf=$_POST["hf"];
        $nh=$_POST["nbre_heure"];

        $nbre_heure=$_POST["nbre_heure"];
        $classes_ids = $_POST['check'] ?? [];
        isEmpty('module',$errors);
        isEmpty('prof',$errors);
        isEmpty('semestre',$errors);
        isEmpty('hd',$errors);
        isEmpty('hf',$errors);
        isEmpty('nbre_heure',$errors);
        isEmpty('date',$errors);

        if ($errors == []) {
            if (isset($_GET["edit"])) {
                modifierCours($_GET["edit"],  $date,$hd,$hf,$nbre_heure,$semestre,$prof,$module);
                misAJourCoursClasses($_GET["edit"],$classes_ids);
            } else {
                $id_cours=ajoutCours($date,$hd,$hf,$nh,$semestre,$prof,$module);
                associerCoursAuxClasses($id_cours,$classes_ids);
                }
            header("Location: " . PAGE . "?controller=rpController&page=coursPlannifier");
            exit();
        }
     }
     if (isset($_GET["edit"])) {
        $cours=valueChampsCours($_GET["edit"]);
     }
    require_once("../app/views/rp/formCours.php");
    $contenu= ob_get_clean();
    require_once("../app/views/layout/baselayout.php");   
}

function voirClasse(){
    ob_start();
    if (isset($_GET['voire'])) {
    $classe=voirClasseFaisantCours($_GET['voire']);
        }
    require_once("../app/views/rp/voirClasse.php");
    $contenu= ob_get_clean();
    require_once("../app/views/layout/baselayout.php");
}

function annuleCours(){
    ob_start();
    if (isset($_GET['action']) && $_GET['action'] == 'traiterArchive') {
        $id = $_GET['id'] ?? null;
        $choix = $_GET['choice'] ?? '';
    
        if ($choix === 'oui' && $id) {
            annulerCours($id);
         }

        header('Location: ' . PAGE . 'controller=rpController&page=coursPlannifier');
    }
    require_once("../app/views/rp/annulerCours.php");
    $contenu= ob_get_clean();
    require_once("../app/views/layout/baselayout.php");
}
