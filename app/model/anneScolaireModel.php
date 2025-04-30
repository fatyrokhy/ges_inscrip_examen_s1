<?php
function idAnneEnCours() {
    $pdo=connexion();
    $select =$pdo->prepare("SELECT id FROM `annees_scolaires` an WHERE an.en_cours=1");
    $select->execute(); 
    $result =  $select->fetch(PDO::FETCH_ASSOC); 
    return $result ? $result['id'] : null; 
}