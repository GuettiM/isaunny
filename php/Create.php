<?php
include 'connexion.php';

// Si le formulaire est soumis
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $titre = mysqli_real_escape_string($connexion, $_POST['titre']);
    $contenu = mysqli_real_escape_string($connexion, $_POST['contenu']);
    
    $requete = "INSERT INTO articles (titre, contenu) VALUES ('$titre', '$contenu')";
    
    if (mysqli_query($connexion, $requete)) {
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
    <title>Créer un article</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Créer un nouvel article</h1>
        
        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Titre</label>
                <input type="text" name="titre" class="form-control" required>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Contenu</label>
                <textarea name="contenu" class="form-control" rows="5" required></textarea>
            </div>
            
            <button type="submit" class="btn btn-success">Publier</button>
            <a href="index.php" class="btn btn-secondary">Annuler</a>
        </form>
    </div>
</body>
</html>