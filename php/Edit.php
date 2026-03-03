<?php
include 'connexion.php';

// Récupérer l'ID de l'article
$id = $_GET['id'];

// Récupérer les données de l'article
$requete = "SELECT * FROM articles WHERE id = $id";
$resultat = mysqli_query($connexion, $requete);
$article = mysqli_fetch_assoc($resultat);

// Si le formulaire est soumis
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titre = mysqli_real_escape_string($connexion, $_POST['titre']);
    $contenu = mysqli_real_escape_string($connexion, $_POST['contenu']);
    
    $requete_update = "UPDATE articles SET titre = '$titre', contenu = '$contenu' WHERE id = $id";
    
    if (mysqli_query($connexion, $requete_update)) {
        header('Location: index.php');
        exit();
    } else {
        echo "Erreur : " . mysqli_error($connexion);
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier l'article</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Modifier l'article</h1>
        
        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Titre</label>
                <input type="text" name="titre" class="form-control" value="<?php echo $article['titre']; ?>" required>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Contenu</label>
                <textarea name="contenu" class="form-control" rows="5" required><?php echo $article['contenu']; ?></textarea>
            </div>
            
            <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
            <a href="index.php" class="btn btn-secondary">Annuler</a>
        </form>
    </div>
</body>
</html>