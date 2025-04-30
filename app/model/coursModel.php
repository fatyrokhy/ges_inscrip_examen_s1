<?php
//lister cours
function listeCoursPlanifie($statut,$roles)  {
    $pdo=connexion();
    $select =$pdo->prepare("SELECT c.*,u.nom,p.id AS id_prof,p.grade AS grade,u.prenom,m.id AS id_module,m.libelle FROM cours c
    JOIN modules m ON m.id=c.module_id
    JOIN professeurs p ON p.id=c.professeur_id
    JOIN utilisateurs u ON u.id=p.utilisateur_id
    WHERE c.statut=:statut AND u.role=:roles");
    $select->execute([':statut'=>$statut,':roles'=>$roles]); 
    $result =  $select->fetchAll(PDO::FETCH_ASSOC); 
    return $result; 
}

//lister classe faisant ce cours 
function findCoursByDate($filtre,$statut,$roles)
{
    $pdo = connexion();
    $sql = "SELECT c.*,u.nom,u.prenom,m.libelle FROM cours c
    JOIN modules m ON m.id=c.module_id
    JOIN professeurs p ON p.id=c.professeur_id
    JOIN utilisateurs u ON u.id=p.utilisateur_id
    WHERE c.statut=:statut AND u.role=:roles";
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
    $cours->execute([':statut'=>$statut,':roles'=>$roles]);
    return $cours->fetchAll(PDO::FETCH_ASSOC);
}

//ajout cours
function ajoutCours($date,$hd,$hf,$nh,$semestre,$prof,$module )  {
    $pdo=connexion();
    $stmt = $pdo->prepare("INSERT INTO cours (date,heure_debut,heure_fin,nbre_heure,semestre,professeur_id,module_id,statut) 
    VALUES (:date,:heure_debut,:heure_fin,:nbre_heure,:semestre, :prof,:module,:statut)
    ");
    $stmt->execute([
    ':date'=>$date,
   ':heure_debut'=> $hd,
   ':heure_fin'=> $hf ,
   ':nbre_heure'=> $nh,
   ':semestre'=> $semestre,
   ':prof'=> $prof ,
   ':module'=> $module ,
   ':statut'=> 'planifier' 
]);
return $pdo->lastInsertId();
}
//ajout dans cours_classe
function associerCoursAuxClasses($cours_id, $classes_ids)
{
    $pdo=connexion();
    $sql = "INSERT INTO cours_classes (cours_id,classe_id) VALUES (:cours, :classe)";
    $stmt = $pdo->prepare($sql);

    foreach ($classes_ids as $id_classe) {
        $stmt->execute([
            ':cours' => $cours_id,
            ':classe' => $id_classe
        ]);
    }
}
 //annuler cours
 function annulerCours($id) {
    $pdo=connexion();
    $select =$pdo->prepare("UPDATE `cours` SET statut='annuler'
     WHERE id = :id");
    $select->execute([':id'=>$id]); 
    return $select;
}

//filtre par prof
function findCoursByProf($nom)  {
    $pdo=connexion();
    $nom = "%$nom%"; 
    $select =$pdo->prepare("SELECT c.*,u.nom,u.prenom,m.libelle,p.grade FROM cours c
    JOIN modules m ON m.id=c.module_id
    JOIN professeurs p ON p.id=c.professeur_id
    JOIN utilisateurs u ON u.id=p.utilisateur_id
    WHERE c.statut = 'planifier'
    AND u.role = 'professeur'
    AND (u.nom LIKE :nom OR u.prenom LIKE :nom)");
    $select->execute([':nom'=>$nom]); 
    $result =  $select->fetchAll(PDO::FETCH_ASSOC); 
    return $result; 
}

//values des champs modif
function valueChampsCours($id)  {
    $pdo=connexion();
    $select =$pdo->prepare("SELECT c.*,u.nom AS nom,u.prenom AS prenom,p.id AS id_prof ,
    m.id AS id_module ,m.libelle AS module,cl.libelle AS libelle ,cl.id AS id_classe 
    FROM cours c
    JOIN modules m ON m.id=c.module_id
    JOIN cours_classes cc ON cc.cours_id=c.id
    JOIN classes cl ON cl.id=cc.classe_id
    JOIN professeurs p ON p.id=c.professeur_id
    JOIN utilisateurs u ON u.id=p.utilisateur_id
    WHERE c.statut='planifier' AND c.id=:id ");
    $select->execute([':id'=>$id]); 
    $result =  $select->fetchAll(PDO::FETCH_ASSOC); 
    if (!$result) return [];

    // On prend les infos du cours dans la première ligne
    $cours = $result[0];
    // On extrait toutes les classes associées
    $cours['classes'] = array_column($result, 'id_classe');
    return $cours; 
}

 //Modification Cours
 function modifierCours($id, $date,$hd,$hf,$nbre_heure,$semestre,$prof,$module)
 {
    $pdo=connexion();
    $select =$pdo->prepare("UPDATE `cours` SET date=:dates,heure_debut=:heure_debut,
    heure_fin=:heure_fin,nbre_heure=:nbre_heure,semestre=:semestre,professeur_id=:prof,module_id=:module,statut=:statut
     WHERE id = :id");
    $select->execute([
        ':id'=>$id,
        ':dates'=>$date,
        ':heure_debut'=>$hd,
        ':heure_fin'=>$hf,
        ':nbre_heure'=>$nbre_heure,
        ':semestre'=>$semestre,
        ':prof'=>$prof,
        ':module'=>$module,
        ':statut'=>'planifier'
    ]);
    return $select;
}
// Modification classe
function misAJourCoursClasses($cours_id, $nouvelles_classes_ids) {
    $pdo = connexion();

    $stmt = $pdo->prepare("DELETE FROM cours_classes WHERE cours_id = :cours_id");
    $stmt->execute([':cours_id' => $cours_id]);

    associerCoursAuxClasses($cours_id, $nouvelles_classes_ids);
}


//cours professeur
function coursProf($professeur)
{
    $pdo = connexion();
    $cours = $pdo->prepare("SELECT c.*,m.libelle as module,u.nom,u.prenom FROM cours as c
    JOIN professeurs as p ON p.id=c.professeur_id
    JOIN modules as m  ON c.module_id=m.id
    JOIN utilisateurs as u  ON p.utilisateur_id=u.id
    WHERE u.role='professeur' AND p.id=:professeur");
    $cours->execute([':professeur'=>$professeur]);
    return $cours->fetchAll(PDO::FETCH_ASSOC);
}





