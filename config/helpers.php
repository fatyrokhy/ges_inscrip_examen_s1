<?php
function isEmpty($name, &$errors)
{
    if (empty(trim($_POST[$name]))) {
        $errors[$name] = ucfirst($name) . " obligatoire*";
    }
}

function verifConnexion($page)
{
    if (!isset($_SESSION['user']) && $page != 'connexion') {
        header('Location: ' . PAGE . 'controller=loginController&page=connexion');
        exit;
    }
    if (isset($_SESSION['user']) && $page == 'connexion') {
        $role = $_SESSION['user']['role'];
        switch ($role) {
            case 'etudiant':
                header('Location: ' . PAGE . 'controller=etudiantController&page=coursEtudiant');
                break;
            case 'responsable':
                header('Location: ' . PAGE . 'controller=rpController&page=dashboardRp');
                break;
            case 'attache':
                header('Location: ' . PAGE . 'controller=atacheController&page=dashboardAttache');
                break;
            case 'professeur':
                header('Location: ' . PAGE . 'controller=etudiantController&page=coursProfesseur');
                break;
            default:
                echo "Vous n'avez pas accés a cette page";
                break;
        }
    }
}

//nbre total d'éléments
function nbreTotal($elements,$etat) {
    $pdo=connexion();
    $total =$pdo->prepare("SELECT COUNT(*) AS total FROM $elements WHERE etat = :etat");
    $total->execute([':etat'=>$etat]); 
    $result = $total->fetch(PDO::FETCH_ASSOC); 
    return intval($result['total'] ?? 0);
}

//POUR Selectionner tableau
function select($elements) {
    $pdo=connexion();
    $select =$pdo->prepare("SELECT *  FROM $elements ");
    $select->execute(); 
    $result = $select->fetchAll(PDO::FETCH_ASSOC); 
    return $result;
}

//pour selectionner un elément specifique
function selectElement($elements,$etat) {
    $pdo=connexion();
    $select =$pdo->prepare("SELECT e.*  FROM $elements e WHERE e.etat = :etat");
    $select->execute([':etat'=>$etat]); 
    $result =  $select->fetchAll(PDO::FETCH_ASSOC); 
    return $result;
}

function paginations($tab, $nbreElementParPage , $p = 1)
{
    $nbreElementTab = count($tab);
    $nbrePage = ceil($nbreElementTab / $nbreElementParPage);
    $debut = ($p - 1) * $nbreElementParPage;
    if ($p < 1 || $p > $nbrePage) {
        return ['data' => [], 'nbrePage' => $nbrePage];
    }

    return [
        'data' => array_slice($tab, $debut, $nbreElementParPage),
        'nbrePage' => $nbrePage
    ];
}




function Pagination( $table, $limit = 10, $page = 1)
{
    $pdo=connexion();
    $offset = ($page - 1) * $limit;

    // Récupérer les données paginées
    $stmt = $pdo->prepare("SELECT * FROM $table LIMIT :limit OFFSET :offset");
    $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
    $stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    $data = $stmt->fetchAll();

    // Compter le nombre total d'éléments
    $totalStmt = $pdo->query("SELECT COUNT(*) FROM $table");
    $totalRows = $totalStmt->fetchColumn();
    $nbrePage = ceil($totalRows / $limit);

    return [
        'data' => $data,
        'nbrePage' => $nbrePage
    ];
}

function dd($die)  {
   echo "<pre>";
    var_dump($die);
    die();
   echo"</pre>";
}

//Numérique
function estNumeric($name,&$errors) {
    if (!empty(trim($_POST[$name]))) {
        if (!is_numeric($_POST[$name])) {
            $errors[$name]=ucfirst($name)." doit etre numerique";
        }
    }
}
//Positif
function estPositif($name,&$errors){
    if (!empty(trim($_POST[$name])) && is_numeric($_POST[$name])) {
        if ($_POST[$name]<=0) {
        $errors[$name]=ucfirst($name)." doit etre positif";
    }
}
}

function renderView(string $dossier,string $view,array $datas=[],string $layout="base"):void{
    ob_start();
   extract($datas);
    require_once "../app/views/$dossier/$view.php";
    $contenu=ob_get_clean();
    require_once "../app/views/layout/$layout.php";
}

function redirection(string $controller, string $page){
    header("Location:".PAGE."?controller=$controller&page=$page");
    exit();
}

function isPost():bool{
    return $_SERVER["REQUEST_METHOD"] == "POST";
}
function isGet():bool{
    return $_SERVER["REQUEST_METHOD"] == "GET";
}


function isConnect():bool {
    return isset($_SESSION["user"]);
}

function addToSession(string $key, $value){
    $_SESSION[$key]=$value;
}

function getUser(){
    return $_SESSION["user"];
}

//Ne pas retourner a la page précédente aprés déconnexion
function NotReturn(){
    if (!isset($_SESSION["user"])){
        redirection('security', 'login');
     exit();
    }
} 
//Ne pas retourner a la page de connexion apres connexion
function NotReturnConnexion($controller,$page){
    if (isset($_SESSION["user"])){
        redirection($controller, $page);
     exit();
    }
}
