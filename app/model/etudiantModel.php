<?php
require_once("../config/database.php");
// liste des cours d'un etudiant
function coursEtudiant()
{
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
// liste des absences
function absenceEtudiant()
{
    $pdo = connexion();
    $absence = $pdo->prepare("SELECT c.date ,m.libelle,c.heure_debut,c.heure_fin,a.justification,a.id FROM `absences` a
    JOIN etudiants e ON e.id=a.etudiant_id
    JOIN cours c ON c.id=a.cours_id
    JOIN modules as m  ON c.module_id=m.id
    WHERE e.id=1;");
    $absence->execute();
    return $absence->fetchAll(PDO::FETCH_ASSOC);
}
// 
function infoEtudiant() {
    $pdo = connexion(); 
    $etud= $pdo->prepare("SELECT u.nom, u.prenom ,c.libelle FROM `utilisateurs` u
JOIN etudiants e ON e.utilisateur_id=u.id
JOIN inscriptions i ON i.etudiant_id=e.id
JOIN classes c ON i.classe_id=c.id
WHERE e.id=1;");
$etud->execute();
return $etud->fetch(PDO::FETCH_ASSOC);
}

function ajoutJustification($id, $motif)
{
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

function justifyAbsence()
{
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


function findCoursBySemestre($semestre)
{
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
        'sem' => $semestre
    ]);
    return $cours->fetchAll(PDO::FETCH_ASSOC);
    // $pdo->prepare("SELECT * FROM `cours` WHERE semestre=:sem");
    // $semestres->execute([
    //     'sem' => $semestre]);
    // return $semestres->fetch(PDO::FETCH_ASSOC); 
}

function findCoursByDates($filtre)
{
    $pdo = connexion();
    switch ($filtre) {
        case 'jour':
            $cours = $pdo->prepare("SELECT c.id, c.date ,c.heure_debut,c.heure_fin,c.semestre,m.libelle,u.nom,u.prenom FROM inscriptions as i
        JOIN classes as cl ON i.classe_id=cl.id
        JOIN etudiants as e ON e.id=i.etudiant_id
        JOIN cours_classes as cc ON cc.classe_id=cl.id
        JOIN cours as c ON cc.cours_id=c.id
        JOIN modules as m  ON c.module_id=m.id
        JOIN professeurs as p  ON c.professeur_id=p.id
        JOIN utilisateurs as u  ON p.utilisateur_id=u.id
        WHERE DATE(date) = CURDATE() AND e.id=1;");
            return $cours->fetchAll(PDO::FETCH_ASSOC);
            break;
        case 'semaine':
            $cours = $pdo->prepare("SELECT c.id, c.date ,c.heure_debut,c.heure_fin,c.semestre,m.libelle,u.nom,u.prenom FROM inscriptions as i
        JOIN classes as cl ON i.classe_id=cl.id
        JOIN etudiants as e ON e.id=i.etudiant_id
        JOIN cours_classes as cc ON cc.classe_id=cl.id
        JOIN cours as c ON cc.cours_id=c.id
        JOIN modules as m  ON c.module_id=m.id
        JOIN professeurs as p  ON c.professeur_id=p.id
        JOIN utilisateurs as u  ON p.utilisateur_id=u.id
        WHERE YEARWEEK(date, 1) = YEARWEEK(CURDATE(), 1) AND e.id=1;");
            $cours->execute([
                'sem' => $filtre
            ]);
            return $cours->fetchAll(PDO::FETCH_ASSOC);
            break;
        case 'mois':
            $cours = $pdo->prepare("SELECT c.id, c.date ,c.heure_debut,c.heure_fin,c.semestre,m.libelle,u.nom,u.prenom FROM inscriptions as i
        JOIN classes as cl ON i.classe_id=cl.id
        JOIN etudiants as e ON e.id=i.etudiant_id
        JOIN cours_classes as cc ON cc.classe_id=cl.id
        JOIN cours as c ON cc.cours_id=c.id
        JOIN modules as m  ON c.module_id=m.id
        JOIN professeurs as p  ON c.professeur_id=p.id
        JOIN utilisateurs as u  ON p.utilisateur_id=u.id
        WHERE MONTH(date) = MONTH(CURDATE()) AND YEAR(date) = YEAR(CURDATE())
        AND e.id=1;");
            $cours->execute([
                'sem' => $filtre
            ]);
            return $cours->fetchAll(PDO::FETCH_ASSOC);
            break;
    }
}

function findCoursByDate($filtre,$etudiant)
{
    $pdo = connexion();
    $sql = "SELECT c.id, c.date, c.heure_debut, c.heure_fin, c.semestre, m.libelle, u.nom, u.prenom
            FROM inscriptions AS i
            JOIN classes AS cl ON i.classe_id = cl.id
            JOIN etudiants AS e ON e.id = i.etudiant_id
            JOIN cours_classes AS cc ON cc.classe_id = cl.id
            JOIN cours AS c ON cc.cours_id = c.id
            JOIN modules AS m ON c.module_id = m.id
            JOIN professeurs AS p ON c.professeur_id = p.id
            JOIN utilisateurs AS u ON p.utilisateur_id = u.id
            WHERE e.id = :etudiant";
    switch ($filtre) {
        case 'jour':
            $sql .= " AND DATE(c.date) = CURDATE()";
            break;
        case 'semaine':
            $sql .= " AND YEARWEEK(c.date, 1) = YEARWEEK(CURDATE(), 1)";
            break;
        case 'mois':
            $sql .= " AND MONTH(c.date) = MONTH(CURDATE()) AND YEAR(c.date) = YEAR(CURDATE())";
            break;
    }
    $sql .= " AND YEAR(c.date) = YEAR(CURDATE())";
    $cours = $pdo->prepare($sql);
    $cours->execute([':etudiant' => $etudiant]);
    return $cours->fetchAll(PDO::FETCH_ASSOC);
}

function findAbsenceByetat($filtre,$etudiant)
{
    $pdo = connexion();
    $absence ="SELECT c.date ,m.libelle,c.heure_debut,c.heure_fin,a.justification,a.id FROM `absences` a
    JOIN etudiants e ON e.id=a.etudiant_id
    JOIN cours c ON c.id=a.cours_id
    JOIN modules as m  ON c.module_id=m.id
    WHERE e.id=:etudiant AND a.justification=:filtre;";
    $cours = $pdo->prepare($absence);
    $cours->execute([':etudiant' => $etudiant,
    ':filtre' => $filtre]);
    return $cours->fetchAll(PDO::FETCH_ASSOC);
}

function findJustifyByStatut($filtre,$etudiant)
{
    $pdo = connexion();
    $absence = "SELECT j.id,c.date ,m.libelle,j.date_justification,j.motif,j.statut FROM  justifications j
    JOIN absences a ON a.id=j.absence_id
    JOIN etudiants e ON e.id=a.etudiant_id
    JOIN cours c ON c.id=a.cours_id
    JOIN modules as m  ON c.module_id=m.id
    WHERE e.id=:etudiant AND j.statut=:filtre;";
    $absences=$pdo->prepare($absence);
    $absences->execute([':etudiant' => $etudiant,':filtre' => $filtre]);
    return $absences->fetchAll(PDO::FETCH_ASSOC);
}
