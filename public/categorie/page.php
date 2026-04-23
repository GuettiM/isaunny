<?PHP 
session_start();
require_once("../../config/database.php");

if (!isset($_GET["id"]) || empty($_GET["id"])) {
    header("Location: categories.php");
    exit;
}

$id = (int) $_GET["id"];

/* Récupérer la catégorie */
$queryCat = $pdo->prepare("SELECT * FROM T_CATEGORIE WHERE id_categorie = ?");
$queryCat->execute([$id]);
$categorie = $queryCat->fetch();

if (!$categorie) {
    header("Location: categories.php");
    exit;
}

/* Récupérer les articles de la catégorie */
$queryArticles = $pdo->prepare("
    SELECT * FROM T_ARTICLE
    WHERE id_categorie = ?
    ORDER BY id_article DESC
");
$queryArticles->execute([$id]);
$articles = $queryArticles->fetchAll();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($categorie["nom"]); ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-color:#0F172A; color:#F8FAFC;">

<div class="container my-5">

    <h1 class="text-center mb-5">
        Catégorie : <?= htmlspecialchars($categorie["nom"]); ?>
    </h1>

    <div class="row g-4">
        <?php if (!empty($articles)): ?>
            <?php foreach ($articles as $article): ?>
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card h-100 shadow" style="background-color:#1E293B; color:#F8FAFC;">
                        
                        <img 
                            src="../img/<?= htmlspecialchars($article["image"]); ?>" 
                            class="card-img-top"
                            style="height:220px; object-fit:cover;"
                        >

                        <div class="card-body d-flex flex-column">
                            <h5><?= htmlspecialchars($article["titre"]); ?></h5>

                            <p style="color:#CBD5E1;">
                                <?= date("d/m/Y", strtotime($article["date"])); ?>
                            </p>

                            <div class="mt-auto">
                                <a href="/ISAUNNY/public/article/page.php?id=<?= $article["id_article"]; ?>" class="btn btn-primary" style="background-color: #6366F1;">
                                    Lire
                                </a>
                            </div>
                        </div>

                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="text-center">Aucun article dans cette catégorie.</p>
        <?php endif; ?>
    </div>

</div>

<?php include("C:/xampp/htdocs/ISAUNNY/public/include/footer.php"); ?>