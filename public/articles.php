<?php
session_start();

require_once("../config/database.php");

$query = $pdo->query(
    "SELECT 
        T_ARTICLE.*,
        T_CATEGORIE.nom AS categorie_nom
    FROM T_ARTICLE
    INNER JOIN T_CATEGORIE ON T_ARTICLE.id_categorie = T_CATEGORIE.id_categorie
    ORDER BY T_ARTICLE.id_article DESC"

);

$articles = $query->fetchAll();

?>


<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Articles - I.sAunny</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="./css/accueil.css">
</head>
<body style="background-color: #0F172A">

  <!-- HEADER / LOGO -->
  <header class="site-header py-1">
    <div class="container text-center">
      <a href="/ISAUNNY/public/index.php" class="logo-link">
        <img src="./img/logo.png" alt="Logo IA Sunny" class="logo-img" style="width: 200px; height: 150px;">
      </a>
    </div>
  </header>

  <!-- NAVBAR -->
  <nav class="navbar navbar-expand-lg sticky-top custom-navbar" style="background-color: #6366F1;">
    <div class="container">
      <a class="navbar-brand text-white fw-bold d-lg-none" href="#">I.sAunny</a>

      <button class="navbar-toggler bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#navbarAccueil">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarAccueil">
        <ul class="navbar-nav mx-auto mb-2 mb-lg-0 gap-lg-4 text-center">
          <li class="nav-item">
            <a class="nav-link active text-white fw-semibold" href="index.php">Accueil</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white fw-semibold" href="articles.php">Article</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white fw-semibold" href="categories.php">Catégorie</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white fw-semibold" href="a-propos.php">À propos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white fw-semibold" href="contact.php">Contact</a>
          </li>
        </ul>

        <div class="text-center">
          <?php if (isset($_SESSION["user"])): ?>
        <span class="text-white fw-bold me-3">
           <?= htmlspecialchars($_SESSION["user"]["pseudo"]); ?>
        </span>
        <?php if ($_SESSION["user"]["role"] === "admin"): ?>
        <a href="/ISAUNNY/public/admin/index.php" class="btn btn-light sm-2 fw-bold px-2 me-2 login-btn" >
           Admin
        </a>
        <a href="/ISAUNNY/public/account.php" class="btn btn-warning sm-2 fw-bold px-2 me-2 login-btn" >
           Membre
        </a>
        <?php endif; ?>

        <?php if ($_SESSION["user"]["role"] === "membre"): ?>
        <a href="/ISAUNNY/public/account.php" class="btn btn-light sm-2 fw-bold px-2 me-2 login-btn" >
           Membre
        </a>
        <?php endif; ?>

        <a href="/ISAUNNY/public/authentificator/logout.php" class="btn btn-danger sm-2 fw-bold px-2 logout-btn">
            Déconnexion
        </a>
    <?php else: ?>
        <a href="/ISAUNNY/public/authentificator/login.php" class="btn btn-light sm-2 fw-bold px-2 login-btn me-2">
            Log In
        </a>

        <a href="/ISAUNNY/public/authentificator/register.php" class="btn btn-outline-light sm-2 fw-bold px-2 register-btn">
            Sign Up
        </a>
    <?php endif; ?>
        </div>
      </div>
    </div>
  </nav>

  <main>
    <!-- BANNIERE -->
    <section >
      <img src="./img/articles.png" alt="Bannière " class="img-fluid w-100 lg-100 hero-img" style="padding: 30px; background-color: #0F172A; ">
    </section>
<div class="container my-5">
    <div class="row g-4">
        <?php foreach ($articles as $article): ?>
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card h-100 shadow" style="background-color: #1E293B; color: #F8FAFC;">
                    <img 
                        src="img/<?= htmlspecialchars($article["image"]); ?>" 
                        class="card-img-top"
                        alt="<?= htmlspecialchars($article["titre"]); ?>"
                        style="height: 220px; object-fit: cover;"
                    >

                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title"><?= htmlspecialchars($article["titre"]); ?></h5>

                        <p class="mb-2" style="color:#CBD5E1; font-size:0.9rem;">
                            <?= htmlspecialchars($article["categorie_nom"]); ?> ·
                            <?= date("d/m/Y", strtotime($article["date"])); ?>
                        </p>

                        <p class="card-text" style="color:#E2E8F0;">
                            <?= htmlspecialchars(mb_strimwidth($article["description"], 0, 120, "...")); ?>
                        </p>

                        <div class="mt-auto">
                            <a href="/ISAUNNY/public/article/page.php?id=<?= $article["id_article"]; ?>" class="btn btn-primary " style="background-color: #6366F1">
                                Lire l’article
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
    </div>
</div>
  </main>

 <!-- FOOTER -->
 <?php include("C:/xampp/htdocs/ISAUNNY/public/include/footer.php"); ?>