<?php
session_start();
require("../config/database.php");

/* Catégories */
$queryCategories = $pdo->query("SELECT * FROM T_CATEGORIE ORDER BY nom ASC");
$categories = $queryCategories->fetchAll();

/* Articles */
$queryArticles = $pdo->query("
    SELECT 
        T_ARTICLE.*,
        T_CATEGORIE.nom AS categorie_nom
    FROM T_ARTICLE
    INNER JOIN T_CATEGORIE ON T_ARTICLE.id_categorie = T_CATEGORIE.id_categorie
    ORDER BY T_ARTICLE.id_article DESC
    LIMIT 6 OFFSET 1
");
$articles = $queryArticles->fetchAll();

$queryFeatured = $pdo->query("
    SELECT 
        T_ARTICLE.*,
        T_CATEGORIE.nom AS categorie_nom
    FROM T_ARTICLE
    INNER JOIN T_CATEGORIE 
    ON T_ARTICLE.id_categorie = T_CATEGORIE.id_categorie
    ORDER BY T_ARTICLE.id_article DESC
    LIMIT 1
");

$featuredArticle = $queryFeatured->fetch();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Accueil - I.sAunny</title>
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
      <img src="./img/accueil.png" alt="Bannière " class="img-fluid w-100 lg-100 hero-img" style="padding: 30px; background-color:#0F172A; ">
    </section>

    <!-- ARTICLE MIS EN AVANT -->
     <?php if ($featuredArticle): ?>
    <section class="featured-article py-5">
      <div class="container">
        <div class="row align-items-center g-4">
          <div class="col-lg-5">
            <div class="featured-image-wrapper">
              <a href="/ISAUNNY/public/article/page.php?id=<?= $featuredArticle["id_article"]; ?>">
              <img src="./img/<?= htmlspecialchars($featuredArticle["image"])?>" alt="Histoire de l'intelligence artificielle" class="img-fluid featured-image"  >
              </a>
            </div>
          </div>

          <div class="col-lg-7">
            <h1 class="featured-title" style="color: #F8FAFC;"><?= htmlspecialchars($featuredArticle["titre"]); ?></h1>
            <p class="featured-text">
             <?= substr(htmlspecialchars($featuredArticle["description"]), 0, 255); ?>
            </p>
          </div>
        </div>
      </div>
    </section>
    <?php endif; ?>

    <!-- CATEGORIES -->
  <section class="categories-section pb-3">
      <div class="container">
        <div class="category-title-box">
          <h2 class="m-0">Catégorie</h2>
        </div>

    <div class="d-flex flex-wrap gap-2 mt-3">
    <?php foreach ($categories as $categorie): ?>
        <a href="/ISAUNNY/public/article/page.php" class="btn category-btn" style="background-color: #6366F1;">
            <?= htmlspecialchars($categorie["nom"]); ?>
        </a>
    <?php endforeach; ?>
    </div>
      </div>
  </section>

    <!-- GRILLE DES ARTICLES -->
    <section class="articles-section py-4">
      <div class="container">
        <div class="row g-4">
          <?php foreach ($articles as $article): ?>
            <div class="col-sm-6 col-lg-4">
              <div class="card article-card h-100">
                <a href="/ISAUNNY/public/article/page.php?id=<?= $article["id_article"]; ?>">
                  <img 
                      src="./img/<?= htmlspecialchars($article["image"]); ?>" 
                      class="card-img-top" 
                      alt="<?= htmlspecialchars($article["titre"]); ?>"
                    >
                </a>
                <div class="card-body">
                    <h5 class="card-title"><?= htmlspecialchars($article["titre"]); ?></h5>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
      </div>
    </section>
  </main>

  <!-- FOOTER -->
  <footer class="site-footer mt-2" style="background-color: #6366F1;">
    <div class="container">
      <div class="text-center">
                <ul class="list-unstyled d-flex justify-content-evenly align-items-center">
                    <li><a href="/ISAUNNY/public/a-propos.php" class="text-decoration-none text-light">À propos</a></li>
                    <li><a href="/ISAUNNY/public/mentions.php" class="text-decoration-none text-light">Mentions légales</a></li>
                    <li><a href="/ISAUNNY/public/politique.php" class="text-decoration-none text-light">Politique de confidentialité</a></li>
                </ul>
            </div>
        <hr style="border-color:#1E293B;">

      <div class="text-center">
            <p class="mb-0">
                © <?= date("Y"); ?> I.sAunny - Tous droits réservés
            </p>
        </div>

    </div>
</footer>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>