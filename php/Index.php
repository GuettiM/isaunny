<?php
// Inclure la connexion
include 'connexion.php';

// Récupérer tous les articles
$requete = "SELECT * FROM articles ORDER BY date_creation DESC";
$resultat = mysqli_query($connexion, $requete);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>I.sAunny</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">I.sAunny</h1>
        
        <a href="create.php" class="btn btn-success mb-3">Créer un nouvel article</a>
        
        <div class="row">
            <?php while($article = mysqli_fetch_assoc($resultat)): ?>
                <div class="col-md-6 mb-3">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $article['titre']; ?></h5>
                            <p class="card-text"><?php echo substr($article['contenu'], 0, 100) . '...'; ?></p>
                            <small class="text-muted"><?php echo $article['date_creation']; ?></small>
                            <div class="mt-2">
                                <a href="edit.php?id=<?php echo $article['id']; ?>" class="btn btn-primary btn-sm">Modifier</a>
                                <a href="delete.php?id=<?php echo $article['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Supprimer cet article ?')">Supprimer</a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
    </div>
</body>
</html>