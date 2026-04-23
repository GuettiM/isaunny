<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Connexion-I sAunny</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="../css/accueil.css">
 <style>
        body {
            background-color: #071331;
            min-height: 100vh;
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
        }

        .register-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 15px;
        }

        .register-card {
            background: #6366F1;
            width: 100%;
            max-width: 430px;
            padding: 55px 40px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.25);
        }

        .register-title {
            color: #ffffff;
            text-align: center;
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 35px;
        }

        .custom-input {
            background-color: #071331;
            border: none;
            border-radius: 0;
            color: #ffffff;
            padding: 14px 16px;
            border-bottom: 2px solid rgba(255,255,255,0.35);
        }

        .custom-input::placeholder {
            color: rgba(255,255,255,0.75);
            text-align: center;
        }

        .custom-input:focus {
            background-color: #071331;
            color: #ffffff;
            box-shadow: none;
            border-bottom: 2px solid #ffffff;
        }

        .btn-register {
            background-color: #071331;
            color: #ffffff;
            border: 2px solid rgba(255,255,255,0.15);
            border-radius: 999px;
            padding: 12px 30px;
            min-width: 220px;
            font-weight: 500;
            transition: 0.3s ease;
        }

        .btn-register:hover {
            background-color: #0b1b45;
            color: #ffffff;
        }

        .register-link {
            color: #ffffff;
            text-decoration: none;
            font-size: 0.95rem;
        }

        .register-link:hover {
            text-decoration: underline;
            color: #ffffff;
        }

        .login-wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px 15px;
        }

        .login-card {
            background: #6366F1;
            width: 100%;
            max-width: 430px;
            padding: 55px 40px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.25);
        }

        .login-title {
            color: #ffffff;
            text-align: center;
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 35px;
        }

        .custom-input {
            background-color: #071331;
            border: none;
            border-radius: 0;
            color: #ffffff;
            padding: 14px 16px;
            border-bottom: 2px solid rgba(255,255,255,0.35);
        }

        .custom-input::placeholder {
            color: rgba(255,255,255,0.75);
            text-align: center;
        }

        .custom-input:focus {
            background-color: #071331;
            color: #ffffff;
            box-shadow: none;
            border-bottom: 2px solid #ffffff;
        }

        .btn-login {
            background-color: #071331;
            color: #ffffff;
            border: 2px solid rgba(255,255,255,0.15);
            border-radius: 999px;
            padding: 12px 30px;
            min-width: 220px;
            font-weight: 500;
            transition: 0.3s ease;
        }

        .btn-login:hover {
            background-color: #0b1b45;
            color: #ffffff;
        }

        .login-link {
            color: #ffffff;
            text-decoration: none;
            font-size: 0.95rem;
        }

        .login-link:hover {
            text-decoration: underline;
            color: #ffffff;
        }
    </style>
</head>
<body>

  <!-- HEADER / LOGO -->
  <header class="site-header py-3">
    <div class="container text-center">
      <a href="../../public/index.php" class="logo-link">
        <img src="../img/logo.png" alt="Logo IA Sunny" class="logo-img" style="width: 200px; height: 150px;">
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
            <a class="nav-link active text-white fw-semibold" href="/ISAUNNY/public/index.php">Accueil</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white fw-semibold" href="/ISAUNNY/public/articles.php">Article</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white fw-semibold" href="/ISAUNNY/public/categories.php">Catégorie</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white fw-semibold" href="/ISAUNNY/public/a-propos.php">À propos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white fw-semibold" href="/ISAUNNY/public/contact.php">Contact</a>
          </li>
        </ul>

        <div class="text-center">
          <a href="../authentificator/login.php" class="btn btn-light fw-bold px-4 login-btn">Log In</a>
          <?php if (isset($_SESSION["user"])): ?>
        <a href="/ISAUNNY/public/authentificator/logout.php" class="btn btn-danger">
        Déconnexion
    </a>
<?php endif; ?>
        </div>
      </div>
    </div>
  </nav>

  <main>