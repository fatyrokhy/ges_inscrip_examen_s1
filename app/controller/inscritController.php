<?php
require_once("../app/model/inscritModel.php");
require_once("../app/model/anneScolaireModel.php");
if (isset($_REQUEST["page"])) {
    $page = $_REQUEST["page"];
    NotReturn();
    switch ($page) {
        case 'listeInscrits':
            listInscrit();
            break;
            case 'formInscrit':
                formInscrit();
                break;
        default:
            
            break;
    }}

    function listInscrit(){
        $classe=selectElement('classes','actif');
       $inscrit=listeInscrit();
       if (isset($_GET["classe"])) {
        $inscrit=findInscritsByClasse($_GET["classe"]);
       }
       renderView('attache','listeInscrits',['inscrit'=>$inscrit,'classe'=>$classe],'baselayout');
    }

    function formInscrit(){
        $classe=selectElement('classes','actif');
        $id_user = null;
        $etudiant_id = null;
        $id_anne=null;
        $prof=null;
        $student=null;
        if (isset($_POST["addEtudiant"])) {
            $nom = $_POST["nom"];
            $prenom = $_POST["prenom"];
            $email = $_POST["email"];
            $pass = $_POST["pass"];
            $matricule = $_POST["matricule"];
            $adresse = $_POST["adresse"];
            $sexe = $_POST["sexe"];
            $classe_id = $_POST["check"];
            isEmpty('nom', $errors);
            isEmpty('email', $errors);
            isEmpty('pass', $errors);
            isEmpty('matricule', $errors);
            isEmpty('adresse', $errors);
            isEmpty('sexe', $errors);
            isEmpty('prenom', $errors);
            isEmpty('check', $errors);
            $etudiant=select('etudiants');
            foreach ($etudiant as $value) {
                if ($value['matricule']==$matricule) {
                    $errors['matricule']='Il semble que cet etudiant existe déjà';
                }
            }
    
            if ($errors == []) {
                if (isset($_GET["edit"])) {
                    $profId = $_GET["edit"];
                    $userId = getUserIdByProfId($profId);
                    modifierUser($userId, $nom, $prenom, $sexe);
                    modifierProf($profId, $matricule, $adresse);
                    misAJourProfClasses($profId, $classe_id);
                } else {
                    $id_user = ajoutUtilisateur($nom, $prenom, $email, $pass, $sexe);
                    $etudiant_id = ajoutEtudiant($id_user, $matricule, $adresse);
                    $id_anne=idAnneEnCours();
                    ajoutInscription($etudiant_id, $classe_id,$id_anne);
                }
                redirection('inscrit', 'listeInscrits');
                exit();
            }
        }
        if (isset($_GET["edit"])) {
            $prof = valueChampsEtudiant(($_GET["edit"]));
        }
        
        if (isset($_GET["reinscrit"])) {
            $student= valueChampsEtudiant(($_GET["reinscrit"]));
        }
    
       renderView('attache','formInscrit',['classe'=>$classe,'id_user'=>$id_user,'etudiant_id'=>$etudiant_id,
       'id_anne'=>$id_anne,'prof'=>$prof,'student'=>$student],'baselayout');
    }
