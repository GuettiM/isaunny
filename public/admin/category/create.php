<?php

session_start();
if (!isset($_SESSION["user"]) || $_SESSION["user"]["role"] !== "admin"){
    header("Location: /ISAUNNY/public/authentificator/login.php");
    exit;
}
require_once("../../../config/database.php");

$erreur = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    $nom = trim($_POST["nom"]);

    if (empty($nom)) {
        $erreur = "Le nom de la catégorie est obligatoire.";
    } else {
        $query = $pdo->prepare("INSERT INTO T_CATEGORIE (nom) VALUES (?)");
        $query->execute([$nom]);

        header("Location: index.php");
        exit;
    }
}

include("C:/xampp/htdocs/ISAUNNY/public/admin/category/include/header.php");
?>

<section class="container my-5">
    <h1 class="text-center mb-4" style="color: #F8FAFC;;">Ajouter une catégorie</h1>

    <?php if (!empty($erreur)): ?>
        <div class="alert alert-danger text-center">
            <?= htmlspecialchars($erreur); ?>
        </div>
    <?php endif; ?>

    <form method="POST" class="w-50 mx-auto">
        <div class="mb-3">
            <label for="nom" class="form-label" style="color: #CBD5E1;">Nom de la catégorie</label>
            <input type="text" name="nom" id="nom" class="form-control" required>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-primary" style="background-color: #6366F1; border-radius: 999px; padding: 10px 34px;">
                Ajouter➕
            </button>
        </div>
    </form>
</section>

 