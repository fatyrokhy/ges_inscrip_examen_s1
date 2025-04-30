<?php
function listeJustification() {
    $pdo=connexion();
    $select =$pdo->prepare("SELECT j.*, a.date as dates,m.libelle as module ,u.nom,u.prenom,e.matricule,cl.libelle as classe
    FROM justifications j 
    JOIN absences a ON j.absence_id=a.id
    JOIN etudiants e ON e.id=a.etudiant_id
    JOIN cours c ON c.id=a.cours_id
    JOIN modules m ON m.id=c.module_id
    JOIN utilisateurs u ON u.id=e.utilisateur_id
    JOIN inscriptions i ON i.etudiant_id=e.id
    JOIN classes cl ON cl.id=i.classe_id
    JOIN annees_scolaires an ON an.id=i.id_annee_scolaire
    WHERE an.en_cours=1");
    $select->execute(); 
    $result =  $select->fetchAll(PDO::FETCH_ASSOC); 
    return $result;
}
