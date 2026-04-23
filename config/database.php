<?php

$host = "mysql:host=localhost;dbname=isaunny"; // Attention pour MAMP, il faut parfois spécifier le port de localhost donc localhost:8080 ou localhost:8888
$login = "root";
$password = ""; // Attention pour MAMP le password c'est "root", pour les autres, pas de password
$options = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING
);

try {
    $pdo = new PDO($host, $login, $password, $options);
} catch (PDOException $e) {

    //  echo "Erreur : " . $e->getMessage(); 
    echo "Erreur de Base de données, revenez plus tard";
    die;
}
?>