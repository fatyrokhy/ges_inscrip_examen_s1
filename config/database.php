<?php
function connexion() {
try {
     $pdo = new PDO("mysql:host=localhost;dbname=gestion_ecole221", "root", "");
       $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); 
       return $pdo;
    } catch (PDOException $e) {
        echo "Connection échouée: " . $e->getMessage();
} 
}