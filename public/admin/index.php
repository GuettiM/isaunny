<?php
session_start();

if (!isset($_SESSION["user"]) || $_SESSION["user"]["role"] !== "admin") {
    header("Location: /ISAUNNY/public/authentificator/login.php");
    exit;
}

require_once("../../config/database.php");

/* Compteurs simples */
$queryArticles = $pdo->query("SELECT COUNT(*) AS total FROM T_ARTICLE");
$totalArticles = $queryArticles->fetch();

$queryCategories = $pdo->query("SELECT COUNT(*) AS total FROM T_CATEGORIE");
$totalCategories = $queryCategories->fetch();

$queryMembres = $pdo->query("SELECT COUNT(*) AS total FROM T_MEMBRE");
$totalMembres = $queryMembres->fetch();

$queryCommentaires = $pdo->query("SELECT COUNT(*) AS total FROM T_COMMENTAIRE");
$totalCommentaires = $queryCommentaires->fetch();

$queryCommentairesAttente = $pdo->query("SELECT COUNT(*) AS total FROM T_COMMENTAIRE WHERE statut = 'en_attente'");
$totalCommentairesAttente = $queryCommentairesAttente->fetch();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - I.sAunny</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style> 
    .login-btn {
  color: #111827;
  border-radius: 999px;
    }
    .logout-btn {
  color: #F8FAFC;
  border-radius: 999px;
    }
    </style>
</head>
<body style="background-color:#0F172A; color:#F8FAFC;">

<nav class="navbar navbar-expand-lg" style="background-color:#6366F1;">
    <div class="container">
        <a class="navbar-brand text-white fw-bold" href="#">Dashboard </a>

        <div class="d-flex align-items-center">
            <span class="text-white me-3">
                <?= htmlspecialchars($_SESSION["user"]["pseudo"]); ?>
            </span>

            <a href="/ISAUNNY/public/index.php" class="btn btn-light btn-sm fw-bold px-4 me-2 login-btn">
                Blog
            </a>

            <?php if ($_SESSION["user"]["role"] === "admin"): ?>
                <a href="/ISAUNNY/public/account.php" class="btn btn-warning btn-sm fw-bold px-4 me-2 login-btn">
                    Membre
                </a>
            <?php endif; ?>

            <a href="/ISAUNNY/public/authentificator/logout.php" class="btn btn-danger btn-sm fw-bold px-4 logout-btn">
                Déconnexion
            </a>
        </div>
    </div>
</nav>

<div class="container my-5">

    <h1 class="text-center mb-5">Tableau de bord administrateur</h1>

    <!-- Cartes statistiques -->
    <div class="row g-4 mb-5">

        <div class="col-12 col-md-6 col-lg-3">
            <div class="card text-center h-100 shadow" style="background-color: #1E293B; color: #F8FAFC;">
                <div class="card-body">
                    <h5 class="card-title">Articles</h5>
                    <p class="display-6"><?= $totalArticles["total"]; ?></p>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 col-lg-3">
            <div class="card text-center h-100 shadow" style="background-color:#1E293B; color:#F8FAFC;">
                <div class="card-body">
                    <h5 class="card-title">Catégories</h5>
                    <p class="display-6"><?= $totalCategories["total"]; ?></p>
                </div>
            </div>
        </div>

         <div class="col-12 col-md-6 col-lg-3">
            <div class="card text-center h-100 shadow" style="background-color:#1E293B; color:#F8FAFC;">
                <div class="card-body">
                    <h5 class="card-title">Membres</h5>
                    <p class="display-6"><?= $totalMembres["total"]; ?></p>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 col-lg-3">
            <div class="card text-center h-100 shadow" style="background-color:#1E293B; color:#F8FAFC;">
                <div class="card-body">
                    <h5 class="card-title">Commentaires</h5>
                    <p class="display-6"><?= $totalCommentaires["total"]; ?></p>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 col-lg-3">
            <div class="card text-center h-100 shadow" style="background-color:#1E293B; color:#F8FAFC;">
                <div class="card-body">
                    <h5 class="card-title">En attente</h5>
                    <p class="display-6"><?= $totalCommentairesAttente["total"]; ?></p>
                </div>
            </div>
        </div>

    </div>

    <!-- Liens rapides -->
    <div class="row g-4">

        <div class="col-12 col-md-6 col-lg-4">
            <div class="card h-100 shadow" style="background-color:#1E293B; color:#F8FAFC;">
                <div class="card-body text-center">
                    <h4 class="card-title mb-3">Articles</h4>
                    <a href="/ISAUNNY/public/admin/article/index.php" class="btn btn-primary">
                        Gérer les articles
                    </a>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 col-lg-4">
            <div class="card h-100 shadow" style="background-color:#1E293B; color:#F8FAFC;">
                <div class="card-body text-center">
                    <h4 class="card-title mb-3">Catégories</h4>
                    <a href="/ISAUNNY/public/admin/category/index.php" class="btn btn-primary">
                        Gérer les catégories
                    </a>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 col-lg-4">
            <div class="card h-100 shadow" style="background-color:#1E293B; color:#F8FAFC;">
                <div class="card-body text-center">
                    <h4 class="card-title mb-3">Membres</h4>
                    <a href="/ISAUNNY/public/admin/member/index.php" class="btn btn-primary">
                        Gérer les Membres
                    </a>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 col-lg-4">
            <div class="card h-100 shadow" style="background-color:#1E293B; color:#F8FAFC;">
                <div class="card-body text-center">
                    <h4 class="card-title mb-3">Commentaires</h4>
                    <a href="/ISAUNNY/public/admin/comment/index.php" class="btn btn-primary">
                        Modérer les commentaires
                    </a>
                </div>
            </div>
        </div>

    </div>

</div>
</body>
</html>