<?php
//courbe Cours Par profeeseurs
function courbeCoursParProf()
{
    $pdo = connexion();

    $profStmt = $pdo->prepare("SELECT * FROM professeurs WHERE etat = 'actif'");
    $profStmt->execute();
    $professeur = $profStmt->fetchAll(PDO::FETCH_ASSOC);

    $data = [];

    foreach ($professeur as $prof) {
        $stmt = $pdo->prepare("SELECT COUNT(cp.id) as total ,u.nom,u.prenom 
        FROM classes_professeurs cp
        JOIN professeurs p ON p.id=cp.professeur_id 
        JOIN utilisateurs u on p.utilisateur_id=u.id
         WHERE cp.professeur_id  = ?");
        $stmt->execute([$prof['id']]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        $data[] = [
            'libelle' =>$result['prenom'].' ' . $result['nom'],
            'total' => intval($result['total'])
        ];
    }
    return  $data;
}

//lister Prof
function listeProf($statut,$roles) {
    $pdo=connexion();
    $select =$pdo->prepare("SELECT p.*,u.nom,u.prenom,u.email,u.sexe,s.libelle AS specialite FROM professeurs p
    JOIN utilisateurs u ON u.id=p.utilisateur_id
    JOIN specialites s ON s.id=p.specialite_id
    WHERE p.etat=:statut AND u.role=:roles");
    $select->execute([':statut'=>$statut,':roles'=>$roles]); 
    $result =  $select->fetchAll(PDO::FETCH_ASSOC); 
    return $result;
}
//rechercher par nom ou prenom
function findProfByNom($nom){
    $pdo=connexion();
    $nom = "%$nom%"; 
    $select =$pdo->prepare("SELECT p.*,u.nom,u.prenom,u.email,u.sexe,s.id AS id_specialite,s.libelle AS specialite FROM professeurs p
    JOIN utilisateurs u ON u.id=p.utilisateur_id
    JOIN specialites s ON s.id=p.specialite_id
    WHERE p.etat='actif'
    AND (u.nom LIKE :nom OR u.prenom LIKE :nom)");
    $select->execute([':nom'=>$nom]); 
    $result =  $select->fetchAll(PDO::FETCH_ASSOC); 
    return $result; 
}
//filtrer par spécialite
function findProfBySpecialite($nom){
    $pdo=connexion();
    $select =$pdo->prepare("SELECT p.*,u.nom,u.prenom,u.email,u.sexe,s.id AS id_specialite,s.libelle AS specialite FROM professeurs p
    JOIN utilisateurs u ON u.id=p.utilisateur_id
    JOIN specialites s ON s.id=p.specialite_id
    WHERE p.etat='actif' AND p.specialite_id=:nom");
    $select->execute([':nom'=>$nom]); 
    $result =  $select->fetchAll(PDO::FETCH_ASSOC); 
    return $result; 
}

//Pour voir les classes faisant le cours plannifié
function voirClassProf($id_prof) {
    $pdo = connexion();
    $req = $pdo->prepare("SELECT c.* FROM classes c
    JOIN classes_professeurs cp ON cp.classe_id=c.id
    JOIN professeurs p ON p.id=cp.professeur_id
    JOIN inscriptions i ON i.classe_id=c.id
    JOIN annees_scolaires ans ON i.id_annee_scolaire=ans.id
    WHERE  ans.en_cours=1 AND c.etat='actif' AND p.id=:id_prof");
    $req->execute([':id_prof' => $id_prof]);
    $result = $req->fetchAll(PDO::FETCH_ASSOC);
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
   ':roles'=> 'professeur',
]);
return $pdo->lastInsertId();
}
//ajouter dans professeur
function ajoutProf($id_user,$grade,$spec)  {
    $pdo=connexion();
    $stmt = $pdo->prepare("INSERT INTO professeurs(utilisateur_id, grade, etat, specialite_id)
    VALUES (:id_user,:grade,:etat,:spec)");
    $stmt ->execute([
        ':id_user'=> $id_user,
        ':grade'=> $grade,
        ':etat'=> 'actif',
        ':spec'=> $spec
    ]);
    return $pdo->lastInsertId();
}

//ajout dans classes_professeurs
function associerProfAuxClasses($prof_id, $classes_ids)
{
    $pdo=connexion();
    $sql = "INSERT INTO classes_professeurs (professeur_id, classe_id) VALUES (:prof, :classe)";
    $stmt = $pdo->prepare($sql);

    foreach ($classes_ids as $id_classe) {
        $stmt->execute([
            ':prof' => $prof_id,
            ':classe' => $id_classe
        ]);
    }
}

//values des champs modif
function valueChampsProf($id)  {
    $pdo=connexion();
    $select =$pdo->prepare("SELECT p.*,u.id AS id_user,u.nom,u.prenom,u.email,u.sexe,u.mot_de_passe,
    s.id AS id_special ,s.libelle AS specialite ,cl.libelle AS libelle ,cl.id AS id_classe
    FROM professeurs p
    JOIN utilisateurs u ON u.id=p.utilisateur_id
    JOIN specialites s ON s.id=p.specialite_id
    JOIN classes_professeurs cp ON cp.professeur_id=p.id
    JOIN classes cl ON cp.classe_id=cl.id
    WHERE p.id=:id ");
    $select->execute([':id'=>$id]); 
    $result =  $select->fetchAll(PDO::FETCH_ASSOC); 
    if (!$result) return [];

    // On prend les infos du prof dans la première ligne
    $prof = $result[0];
    // On extrait toutes les classes associées
    $prof['classes'] = array_column($result, 'id_classe');
    return $prof; 
}

 //Modification Utilisateur
 function modifierUser($id,$nom,$prenom,$sexe)
 {
    $pdo=connexion();
    $select =$pdo->prepare("UPDATE utilisateurs u SET nom=:nom,prenom=:prenom,
    sexe=:sexe
    WHERE u.id=:id");
    $select->execute([
        ':id'=>$id,
        ':nom'=>$nom,
        ':prenom'=> $prenom,
        ':sexe'=> $sexe,
         ]);
    return $select;
}
//Modification Professeur
function modifierProf($id,$grade,$spec)
{
   $pdo=connexion();
   $select =$pdo->prepare("UPDATE professeurs p SET grade=:grade,etat=:etat,specialite_id=:spec
   WHERE p.id=:id");
   $select->execute([
       ':id'=>$id,
       ':grade'=>$grade,
       ':etat'=> 'actif',
       ':spec'=> $spec
        ]);
   return $select;
}

// Modification classes_professeurs
function misAJourProfClasses($prof_id, $nouvelles_classes_ids) {
    $pdo = connexion();

    $stmt = $pdo->prepare("DELETE FROM classes_professeurs WHERE professeur_id = :prof_id");
    $stmt->execute([':prof_id' => $prof_id]);

    associerprofAuxClasses($prof_id, $nouvelles_classes_ids);
}

//Recupérer l'id_utilisateur
function getUserIdByProfId($profId) {
    $pdo = connexion();
    $stmt = $pdo->prepare("SELECT utilisateur_id FROM professeurs WHERE id = :id");
    $stmt->execute([':id' => $profId]);
    $result = $stmt->fetch();
    return $result ? $result['utilisateur_id'] : null;
}

// Archiver
function archiveProf($id) {
    $pdo=connexion();
    $select =$pdo->prepare("UPDATE `professeurs` SET etat='archiver'
     WHERE id = :id");
    $select->execute([':id'=>$id]); 
    return $select;
}

function getProf($id) {
    $pdo=connexion();
    $select =$pdo->prepare("SELECT *  FROM professeurs p
   Where p.utilisateur_id=:id");
    $select->execute([':id'=>$id]); 
    $result = $select->fetch(PDO::FETCH_ASSOC); 
    return $result;
}


