<?php
session_start();

if (!isset($_SESSION["user"]) || $_SESSION["user"]["role"] !== "admin") {
    header("Location: /ISAUNNY/public/authentificator/login.php");
    exit;
}

require_once("../../../config/database.php");

$erreur = "";


$queryCategories = $pdo->query("SELECT * FROM T_CATEGORIE ORDER BY nom ASC");
$categories = $queryCategories->fetchAll();

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $titre = trim($_POST["titre"]);
    $image = trim($_POST["image"]);
    $description = trim($_POST["description"]);
    $date = trim($_POST["date"]);
    $id_categorie = (int) $_POST["id_categorie"];

    if (empty($titre) || empty($image) || empty($description) || empty($date) || empty($id_categorie)) {
        $erreur = "Tous les champs sont obligatoires.";
    } else {
        $query = $pdo->prepare("
            INSERT INTO T_ARTICLE (titre, image, description, date, id_categorie)
            VALUES (?, ?, ?, ?, ?)
        ");
        $query->execute([$titre, $image, $description, $date, $id_categorie]);

        header("Location: index.php");
        exit;
    }
}

include("C:/xampp/htdocs/ISAUNNY/public/admin/article/include/header.php");
?>

<div class="container my-5">
    <h1 class="text-center mb-4" style="color: #F8FAFC;">Ajouter un article</h1>

    <?php if (!empty($erreur)): ?>
        <div class="alert alert-danger text-center">
            <?= htmlspecialchars($erreur); ?>
        </div>
    <?php endif; ?>

    <form method="POST" class="w-50 mx-auto">

        <div class="mb-3">
            <label for="titre" class="form-label" style="color: #F8FAFC;">Titre</label>
            <input 
                type="text" 
                name="titre" 
                id="titre"
                class="form-control"
                value="<?= isset($_POST["titre"]) ? htmlspecialchars($_POST["titre"]) : ""; ?>"
                required
            >
        </div>

        <div class="mb-3">
            <label for="image" class="form-label" style="color: #F8FAFC;">Image</label>
            <input 
                type="text" 
                name="image" 
                id="image"
                class="form-control"
                placeholder="../../assets/histoire.png"
                value="<?= isset($_POST["image"]) ? htmlspecialchars($_POST["image"]) : ""; ?>"
                required
            >
        </div>

        <div class="mb-3">
            <label for="description" class="form-label" style="color: #F8FAFC;">Description</label>
            <textarea 
                name="description" 
                id="description"
                class="form-control"
                rows="5"
                required
            ><?= isset($_POST["description"]) ? htmlspecialchars($_POST["description"]) : ""; ?></textarea>
        </div>

        <div class="mb-3">
            <label for="date" class="form-label" style="color: #F8FAFC;">Date</label>
            <input 
                type="date" 
                name="date" 
                id="date"
                class="form-control"
                value="<?= isset($_POST["date"]) ? htmlspecialchars($_POST["date"]) : ""; ?>"
                required
            >
        </div>

        <div class="mb-3">
            <label for="id_categorie" class="form-label" style="color: #F8FAFC;">Catégorie</label>
            <select name="id_categorie" id="id_categorie" class="form-select" required>
                <option value="">-- Choisir une catégorie --</option>
                <?php foreach ($categories as $categorie): ?>
                    <option 
                        value="<?= $categorie["id_categorie"]; ?>"
                        <?= (isset($_POST["id_categorie"]) && $_POST["id_categorie"] == $categorie["id_categorie"]) ? "selected" : ""; ?>
                    >
                        <?= htmlspecialchars($categorie["nom"]); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="text-center mt-4">
            <button type="submit" class="btn btn-primary" style="background-color: #6366F1; border-radius: 999px; padding: 10px 34px;">
                Ajouter ➕
            </button>
        </div>
    </form>
</div>