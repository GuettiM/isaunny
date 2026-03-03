<?php
// Paramètres de connexion à la base de données
$serveur = "localhost";
$utilisateur = "root";
$mot_de_passe = "";
$base_de_donnees = "ISAUNNY";

// Connexion à MySQL
$connexion = mysqli_connect($serveur, $utilisateur, $mot_de_passe, $base_de_donnees);

// Vérifier si la connexion fonctionne
if (!$connexion) {
    die("Erreur de connexion : " . mysqli_connect_error());
}

// Message de confirmation (tu peux le retirer plus tard)
echo "Connexion réussie à la base de données !";
?>