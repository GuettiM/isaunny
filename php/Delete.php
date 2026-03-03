<?php
include 'connexion.php';

// Récupérer l'ID de l'article à supprimer
$id = $_GET['id'];

// Supprimer l'article
$requete = "DELETE FROM articles WHERE id = $id";

if (mysqli_query($connexion, $requete)) {
    header('Location: index.php');
    exit();
} else {
    echo "Erreur lors de la suppression : " . mysqli_error($connexion);
}
?>