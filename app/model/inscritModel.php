<?php
function listeInscrit() {
    $pdo=connexion();
    $select =$pdo->prepare("SELECT i.*,c.libelle AS classe,u.nom,u.prenom,
    u.sexe,u.email,an.libelle AS annee,e.matricule,e.adresse FROM inscriptions i 
    JOIN etudiants e ON e.id=i.etudiant_id
    JOIN classes c ON c.id=i.classe_id
    JOIN annees_scolaires an ON an.id=i.id_annee_scolaire
    JOIN utilisateurs u ON u.id=e.utilisateur_id
    WHERE an.en_cours=1");
    $select->execute(); 
    $result =  $select->fetchAll(PDO::FETCH_ASSOC); 
    return $result;
}

function findInscritsByClasse($id) {
    $pdo=connexion();
    $select =$pdo->prepare("SELECT i.*,c.libelle AS classe,u.nom,u.prenom,
    u.sexe,u.email,an.libelle AS annee,e.matricule,e.adresse FROM inscriptions i 
    JOIN etudiants e ON e.id=i.etudiant_id
    JOIN classes c ON c.id=i.classe_id
    JOIN annees_scolaires an ON an.id=i.id_annee_scolaire
    JOIN utilisateurs u ON u.id=e.utilisateur_id
    WHERE c.id=:id AND  an.en_cours=1");
    $select->execute([':id'=>$id]); 
    $result =  $select->fetchAll(PDO::FETCH_ASSOC); 
    return $result;
}

function findInscritsByEtudiant($matricule) {
    $pdo=connexion();
    $matricule="$matricule";
    $select =$pdo->prepare("SELECT i.*,c.libelle AS classe,u.nom,u.prenom,
    u.sexe,u.email,an.libelle AS annee,e.matricule,e.adresse FROM inscriptions i 
    JOIN etudiants e ON e.id=i.etudiant_id
    JOIN classes c ON c.id=i.classe_id
    JOIN annees_scolaires an ON an.id=i.id_annee_scolaire
    JOIN utilisateurs u ON u.id=e.utilisateur_id
    WHERE e.matricule like ':matricule AND  an.en_cours=1");
    $select->execute([':matricule'=>$matricule]); 
    $result =  $select->fetchAll(PDO::FETCH_ASSOC); 
    return $result;
}

//Ajouter d'abord l'utilisateur
function ajoutUtilisateur($nom,$prenom,$email,$pass,$sexe)  {
    $pdo=connexion();
    $stmt = $pdo->prepare("INSERT INTO utilisateurs(nom, prenom, sexe,email, mot_de_passe, `role`)
    VALUES (:nom,:prenom,:sexe,:email, :pass,:roles)
    ");
    $stmt->execute([
    ':nom'=>$nom,
   ':prenom'=> $prenom,
   ':sexe'=> $sexe ,
   ':email'=> $email,
   ':pass'=> $pass ,
   ':roles'=> 'etudiant',
]);
return $pdo->lastInsertId();
}
//ajouter dans etudiant
function ajoutEtudiant($id_user,$matricule,$adresse)  {
    $pdo=connexion();
    $stmt = $pdo->prepare("INSERT INTO etudiants(utilisateur_id, matricule, adresse)
    VALUES (:id_user,:matricule,:adresse)");
    $stmt ->execute([
        ':id_user'=> $id_user,
        ':matricule'=> $matricule,
        ':adresse'=> $adresse
    ]);
    return $pdo->lastInsertId();
}

//ajout dans inscription
function ajoutInscription($etudiant_id, $classes_id,$anne_id)
{

    $pdo=connexion();
    $sql = "INSERT INTO inscriptions (etudiant_id, classe_id,id_annee_scolaire) VALUES (:etudiant_id, :classe_id,:anne_id)";
    $stmt = $pdo->prepare($sql);

        $stmt->execute([
            ':etudiant_id' => $etudiant_id,
            ':classe_id' => $classes_id,
            ':anne_id' => $anne_id,
        ]);
}

//values des champs modif
function valueChampsEtudiant($id)  {
    $pdo=connexion();
    $select =$pdo->prepare("SELECT i.*,c.id AS id_classe,e.id AS etudiant_id,c.libelle AS classe,
    u.id AS id_user,u.nom AS nom,u.prenom AS prenom,u.sexe AS sexe,u.email AS email,u.mot_de_passe AS pass,
    an.id AS anne_id,an.libelle AS annee,e.matricule AS matricule,e.adresse AS adresse 
    FROM inscriptions i 
    JOIN etudiants e ON e.id=i.etudiant_id
    JOIN classes c ON c.id=i.classe_id
    JOIN annees_scolaires an ON an.id=i.id_annee_scolaire
    JOIN utilisateurs u ON u.id=e.utilisateur_id
    WHERE an.en_cours=1 AND i.id=:id ");
    $select->execute([':id'=>$id]); 
    $result =  $select->fetch(PDO::FETCH_ASSOC); 
     return $result ;

}

