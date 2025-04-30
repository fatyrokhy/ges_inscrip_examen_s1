<?php
function courbeCoursParClasse()
{
    $pdo = connexion();

    $classesStmt = $pdo->prepare("SELECT * FROM classes WHERE etat != 'archiver'");
    $classesStmt->execute();
    $classes = $classesStmt->fetchAll(PDO::FETCH_ASSOC);

    $data = [];

    foreach ($classes as $classe) {
        $stmt = $pdo->prepare("SELECT COUNT(*) as total FROM cours_classes WHERE classe_id = ?");
        $stmt->execute([$classe['id']]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        $data[] = [
            'libelle' => $classe['libelle'],
            'total' => intval($result['total'])
        ];
    }
    return  $data;
}

//lister classe
function listeClasses($etat)
{
    $pdo = connexion();
    $select = $pdo->prepare("SELECT c.*,n.libelle AS niveau,f.libelle AS filiere FROM classes c 
    JOIN filieres f ON f.id=c.id_filiere
    JOIN niveaux n ON n.id=c.id_niveau
     WHERE c.etat = :etat ");
    $select->execute([':etat' => $etat]);
    $result =  $select->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

//filtrer par filiere et par Niveau
function findClassByFiliereOrNiveau($etat, $filiere, $niveau)
{
    $pdo = connexion();
    $select = $pdo->prepare("SELECT c.*,n.libelle AS niveau,f.libelle AS filiere FROM classes c 
    JOIN filieres f ON f.id=c.id_filiere
    JOIN niveaux n ON n.id=c.id_niveau
     WHERE c.etat = :etat AND f.libelle = :filtre OR n.libelle = :filtrer");
    $select->execute([':etat' => $etat, ':filtre' => $filiere, ':filtrer' => $niveau]);
    $result =  $select->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}

function ajoutClasse($libelle, $niveau, $filiere)
{
    $pdo = connexion();
    $stmt = $pdo->prepare("
    INSERT INTO classes (libelle, id_niveau, id_filiere) 
    VALUES (:libelle, (SELECT id FROM niveaux WHERE libelle = :niveau), (SELECT id FROM filieres WHERE libelle = :filiere))
    ");
    $stmt->execute([
        ':libelle' => $libelle,
        ':niveau' => $niveau,
        ':filiere' => $filiere
    ]);
}

//archiver
function archiveClasse($id)
{
    $pdo = connexion();
    $select = $pdo->prepare("UPDATE `classes` SET etat='archiver'
     WHERE id = :id");
    $select->execute([':id' => $id]);
    return $select;
}
//edit
function valueChamp($id)
{
    $pdo = connexion();
    $select = $pdo->prepare("SELECT c.*, n.libelle AS niveau, f.libelle AS filiere 
        FROM classes c 
        JOIN filieres f ON f.id = c.id_filiere
        JOIN niveaux n ON n.id = c.id_niveau
        WHERE c.id = :id");
    $select->execute([':id' => $id]);
    $result = $select->fetch(PDO::FETCH_ASSOC);
    return $result;
}


//Pour récupérer l'id d'un élement
function getIdByLibelles($table, $libelle)
{
    $pdo = connexion();
    $req = $pdo->prepare("SELECT id FROM $table WHERE libelle = :libelle");
    $req->execute(['libelle' => $libelle]);
    return $req->fetch(PDO::FETCH_ASSOC)['id'] ?? null;
}

//Récupérer les étudiants de l'année en cours
function voirEtudiant($id_classe)
{
    $pdo = connexion();
    $req = $pdo->prepare("SELECT i.*,u.*,e.* FROM inscriptions i 
    JOIN etudiants e ON e.id=i.etudiant_id
    JOIN classes c ON c.id=i.classe_id
    JOIN annees_scolaires ans ON ans.id=i.id_annee_scolaire
    JOIN utilisateurs u ON u.id=e.utilisateur_id
    WHERE ans.en_cours=1 AND u.role='etudiant' AND c.id=:id_classe");
    $req->execute(['id_classe' => $id_classe]);
    $result = $req->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}


//Modifier
function modifClasse($id, $libelle, $niveau, $filiere)
{
    $pdo = connexion();
    $select = $pdo->prepare("UPDATE `classes` SET libelle=:libelle,id_niveau=:niveau,id_filiere=:filiere
     WHERE id = :id");
    $select->execute([':id' => $id, ':libelle' => $libelle, ':niveau' => $niveau, ':filiere' => $filiere]);
    return $select;
}

//Pour voir les classes faisant le cours plannifié
function voirClasseFaisantCours($id_cours)
{
    $pdo = connexion();
    $req = $pdo->prepare("SELECT * FROM classes c
    JOIN cours_classes cc ON cc.classe_id=c.id
    JOIN cours cr ON cr.id=cc.cours_id
    WHERE  cr.id=:id_cours AND c.etat='actif'");
    $req->execute(['id_cours' => $id_cours]);
    $result = $req->fetchAll(PDO::FETCH_ASSOC);
    return $result;
}
