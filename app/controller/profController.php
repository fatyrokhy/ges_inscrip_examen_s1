<?php
require_once("../app/model/profModel.php");
if (isset($_REQUEST["page"])) {
    $page = $_REQUEST["page"];
    NotReturn();
    NotReturnConnexion('prof','prof');
    if ($page == 'prof') {
        prof();
    } elseif ($page == 'voirClasseProf') {
        voirClasseProf();
    } elseif ($page == 'formProf') {
        formProf();
    } elseif ($page == 'archiverProf') {
        archiverProf();
    }
}


function prof()
{
    $prof = listeProf("actif", "professeur");
    $specialite = select('specialites');
    if (isset($_GET["prof"])) {
        $prof = findProfByNom($_GET["prof"]);
    }
    if (isset($_GET["specialite"])) {
        $prof = findProfBySpecialite($_GET["specialite"]);
    }
    renderView('rp', 'prof', ['prof' => $prof, 'specialite' => $specialite], 'baselayout');
}

function voirClasseProf()
{
    if (isset($_GET['voire'])) {
        $class = voirClassProf($_GET['voire']);
    }
    renderView('rp', 'voirClasseProf', ['class' => $class], 'baselayout');
}

function archiverProf()
{
    if (isset($_GET['action']) && $_GET['action'] == 'traiterArchive') {
        $id = $_GET['id'] ?? null;
        $choix = $_GET['choice'] ?? '';
        if ($choix === 'oui' && $id) {
            archiveProf($id);
        }
        redirection('prof', 'prof');
    }
    renderView('rp', 'archiverProf', [], 'baselayout');
}

function formProf()
{
    $errors = [];
    $specialite = select('specialites');
    $classe = selectElement('classes', 'actif');
    $prof = null;
    if (isset($_POST["addProf"])) {
        $nom = $_POST["nom"];
        $prenom = $_POST["prenom"];
        $email = $_POST["email"];
        $pass = $_POST["pass"];
        $spec = $_POST["specialite"];
        $grade = $_POST["grade"];
        $sexe = $_POST["sexe"];
        $prenom = $_POST["prenom"];
        $classes_ids = $_POST['check'] ?? [];
        isEmpty('nom', $errors);
        isEmpty('email', $errors);
        isEmpty('pass', $errors);
        isEmpty('specialite', $errors);
        isEmpty('grade', $errors);
        isEmpty('sexe', $errors);
        isEmpty('prenom', $errors);

        if ($errors == []) {
            if (isset($_GET["edit"])) {
                $profId = $_GET["edit"];
                $userId = getUserIdByProfId($profId);
                modifierUser($userId, $nom, $prenom, $sexe);
                modifierProf($profId, $grade, $spec);
                misAJourProfClasses($profId, $classes_ids);
            } else {
                $id_user = ajoutUtilisateur($nom, $prenom, $email, $pass, $sexe);
                $prof_id = ajoutProf($id_user, $grade, $spec);
                associerProfAuxClasses($prof_id, $classes_ids);
            }
            redirection('prof', 'prof');
            exit();
        }
    }

    if (isset($_GET["edit"])) {
        $prof = valueChampsProf(($_GET["edit"]));
    }

    renderView('rp', 'formProf', ['specialite' => $specialite, 'classe' => $classe, 'prof' => $prof ], 'baselayout');
}
