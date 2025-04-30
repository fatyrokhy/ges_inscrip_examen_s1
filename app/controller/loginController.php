<?php
require_once("../app/model/modelUtilisateur.php");
require_once("../app/model/etudiantModel.php");
require_once("../app/model/profModel.php");
if (isset($_REQUEST["page"])) {
    $page = $_REQUEST["page"];
    if ($page == 'connexion') {
        verifConnexion($page);
        login();
    } elseif ($page == 'deconnexion') {
        logout();
        }
} else {
    login();
}

function login()
{
    ob_start();
    $errors = [];
    if (isset($_POST["add"])) {
        isEmpty('email', $errors);
        isEmpty('pass', $errors);
        $utilisateur = seConnecter($_POST["email"], $_POST["pass"]);
        // dd($utilisateur);
        if ($utilisateur) {
            
            switch ($utilisateur['role']) {
                case 'etudiant':
                    $_SESSION['user'] = $utilisateur;
                    $etudiant=getEtudiant($_SESSION["user"]["id"]);
                    $_SESSION['user']['matricule'] = $etudiant["matricule"];
                    redirection('etudiant','coursEtudiant');
                    break;
                case 'responsable':
                    $_SESSION['user'] = $utilisateur;
                    redirection('rpController','dashboardRp');
                    break;
                    case 'attache':
                        $_SESSION['user'] = $utilisateur;
                        redirection('inscrit','listeInscrits');
                        break;
                        case 'professeur':
                            $_SESSION['user'] = $utilisateur;
                            $prof=getProf($_SESSION["user"]["id"]);
                             $_SESSION['user']['grade'] = $prof["grade"];
                            redirection('cours','mesCours');
                            break;
                default:
                    echo "Vous n'avez pas le rôle requis pour accéder à cette page.";
                    break;
            }
        } else {
            $errors['global'] = "Email ou mot de passe incorrect.";
        }
    }
    renderView('authentification','connexion',[],'securitylayout');
}

function logout() {
    unset($_SESSION['user'] );
    session_destroy();
    header('Location: ' . PAGE . 'controller=security&page=connexion');
}
