<?php
require_once("../config/database.php");
function coursEtudiant()  {
    $pdo = connexion(); 
    $cours = $pdo->prepare("SELECT c.id, c.date ,c.heure_debut,c.heure_fin,c.semestre,m.libelle,u.nom,u.prenom FROM inscriptions as i
    JOIN classes as cl ON i.classe_id=cl.id
    JOIN etudiants as e ON e.id=i.etudiant_id
    JOIN cours_classes as cc ON cc.classe_id=cl.id
    JOIN cours as c ON cc.cours_id=c.id
    JOIN modules as m  ON c.module_id=m.id
    JOIN professeurs as p  ON c.professeur_id=p.id
    JOIN utilisateurs as u  ON p.utilisateur_id=u.id
    WHERE e.id=1;");
    $cours->execute(); 
    return $cours->fetchAll(PDO::FETCH_ASSOC); 
    
}
function absenceEtudiant() {
    $pdo = connexion(); 
    $absence = $pdo->prepare("SELECT c.date ,m.libelle,c.heure_debut,c.heure_fin,a.justification,a.id FROM `absences` a
    JOIN etudiants e ON e.id=a.etudiant_id
    JOIN cours c ON c.id=a.cours_id
    JOIN modules as m  ON c.module_id=m.id
    WHERE e.id=1;");
    $absence->execute(); 
    return $absence->fetchAll(PDO::FETCH_ASSOC); 
}

function ajoutJustification($id, $motif) {
    $pdo = connexion(); 
    $justify = $pdo->prepare("INSERT INTO justifications (absence_id, date_justification, motif, statut, traite_par, date_traitement, commentaire) 
    VALUES (:id, :date_justification, :motif, :statut, :traite_par, :date_traitement, :commentaire)");

    $justify->execute([
        ':id' => $id,
        ':date_justification' => date('Y-m-d'),
        ':motif' => $motif,
        ':statut' => 'EN_ATTENTE',
        ':traite_par' => NULL,
        ':date_traitement' => NULL,
        ':commentaire' => NULL
    ]);
}

function justifyAbsence() {
    $pdo = connexion(); 
    $absence = $pdo->prepare("SELECT j.id,c.date ,m.libelle,j.date_justification,j.motif,j.statut FROM  justifications j
    JOIN absences a ON a.id=j.absence_id
    JOIN etudiants e ON e.id=a.etudiant_id
    JOIN cours c ON c.id=a.cours_id
    JOIN modules as m  ON c.module_id=m.id
    WHERE e.id=1;");
    $absence->execute(); 
    return $absence->fetchAll(PDO::FETCH_ASSOC); 
}


function findCoursBySemestre( $semestre) {
    $pdo = connexion(); 
    $cours = $pdo->prepare("SELECT c.id, c.date ,c.heure_debut,c.heure_fin,c.semestre,m.libelle,u.nom,u.prenom FROM inscriptions as i
    JOIN classes as cl ON i.classe_id=cl.id
    JOIN etudiants as e ON e.id=i.etudiant_id
    JOIN cours_classes as cc ON cc.classe_id=cl.id
    JOIN cours as c ON cc.cours_id=c.id
    JOIN modules as m  ON c.module_id=m.id
    JOIN professeurs as p  ON c.professeur_id=p.id
    JOIN utilisateurs as u  ON p.utilisateur_id=u.id
    WHERE c.semestre=:sem AND e.id=1;");
    $cours->execute([
        'sem' => $semestre]); 
    return $cours->fetchAll(PDO::FETCH_ASSOC); 
    // $pdo->prepare("SELECT * FROM `cours` WHERE semestre=:sem");
    // $semestres->execute([
    //     'sem' => $semestre]);
    // return $semestres->fetch(PDO::FETCH_ASSOC); 
}

