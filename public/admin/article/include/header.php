<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Article Admin - I.sAunny</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../../../css/accueil.css">
  <style>
    body {
      background-color: #0F172A;
      
    }
  input {
      display: flex;
      justify-content: center;
    }
  .logout-btn {
  color: #F8FAFC;;
  border-radius: 999px;
}
  .login-btn {
  color: #111827;
  border-radius: 999px;
}
  </style>
</head>
<body>

  <!-- HEADER / LOGO -->
  <header class="site-header py-3">
    <div class="container text-center">
      <a href="/ISAUNNY/public/index.php" class="logo-link">
        <img src="../../../public/img/logo.png" alt="Logo IA Sunny" class="logo-img" style="width: 200px; height: 150px;">
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
            <a class="nav-link active text-white fw-semibold" href="/ISAUNNY/public/admin/index.php">Dashboard</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white fw-semibold" href="/ISAUNNY/public/admin/category/index.php">Catégories</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white fw-semibold" href="/ISAUNNY/public/admin/article/index.php">Articles</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white fw-semibold" href="/ISAUNNY/public/admin/member/index.php">Membres</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white fw-semibold" href="/ISAUNNY/public/admin/comment/index.php">Commentaires</a>
          </li>
        </ul>
        <div class="d-flex align-items-center">
            <span class="text-white me-3">
                <?= htmlspecialchars($_SESSION["user"]["pseudo"]); ?>
            </span>
            <a href="/ISAUNNY/public/index.php" class="btn btn-light fw-bold px-4 me-2 login-btn">
                Blog
            </a>

            <a href="/ISAUNNY/public/authentificator/logout.php" class="btn btn-danger fw-bold px-4 logout-btn">
                Déconnexion
            </a>
        </div>
      </div>
    </div>
  </nav>

  <main>

  



