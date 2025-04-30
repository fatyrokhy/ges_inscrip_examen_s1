<?php
function seConnecter($mail,$pass)  {
    $pdo = connexion(); 
    $user = $pdo->prepare("SELECT * FROM utilisateurs u 
    WHERE u.email =:mail AND u.mot_de_passe=:pass");
    $user->execute([':mail'=>$mail,
    ':pass'=>$pass]); 
    return $user->fetch(PDO::FETCH_ASSOC);
}

