<?php
session_start();
require_once("../config/mail.php");

$erreur = "";
$success = "";

if($_SERVER["REQUEST_METHOD"] === "POST") {
    $nom = trim($_POST["nom"]);
    $email = trim($_POST["email"]);
    $message = trim($_POST["message"]);

    if (empty($nom) || empty($email) || empty($message)) {
        $erreur = "Tous les champs sont obligatoires.";
    } else {

        if(sendContactEmail($nom, $email, $message)) {
            $success = "Votre message a bien été envoyé.";
        } else {
            $erreur = "Erreur lors de l'envoi du message.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Contact - I.sAunny</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="./css/accueil.css">
  <style>
    label{
        color:  #CBD5E1;
        font-weight: bold;
    }
  </style>
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
      <img src="./img/contact.png" alt="Bannière " class="img-fluid w-100 lg-100 hero-img" style="padding: 30px; background-color:#0F172A; ">
    </section>
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-md-6">

            <?php if (!empty($erreur)): ?>
                <div class="alert alert-danger"><?= $erreur; ?></div>
            <?php endif; ?>

            <?php if (!empty($success)): ?>
                <div class="alert alert-success"><?= $success; ?></div>
            <?php endif; ?>

            <form method="POST">

                <div class="mb-3">
                    <label>Nom</label>
                    <input type="text" name="nom" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label>Message</label>
                    <textarea name="message" class="form-control" rows="5" required></textarea>
                </div>

                <button class="btn btn-primary w-100" style="background-color: #6366F1;">Envoyer</button>

            </form>

            </div>
        </div>
    </div>
</main>
 <!-- FOOTER -->
 <?php include("C:/xampp/htdocs/ISAUNNY/public/include/footer.php"); ?>