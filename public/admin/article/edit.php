<?php 
session_start();

if(!isset($_SESSION["user"]) || $_SESSION["user"]["role"] !== "admin"){
    header("Location: /ISAUNNY/public/authentificator/login.php");
    exit;
}

require_once("../../../config/database.php");

if (!isset($_GET["id"]) || empty($_GET["id"])) {
    header("Location: index.php");
    exit;
}

$id = (int) $_GET["id"];

$query = $pdo->prepare("SELECT * FROM T_ARTICLE WHERE id_article = ?");
$query->execute([$id]);

$article = $query->fetch();

if (!$article) {
    header("Location: index.php");
    exit;
}

$queryCategories = $pdo->query("SELECT * FROM T_CATEGORIE ORDER BY nom ASC");
$categories = $queryCategories->fetchAll();

$erreur = "";

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
            UPDATE T_ARTICLE 
            SET titre = ?, image = ?, description = ?, date = ?, id_categorie = ?
            WHERE id_article = ?
        ");

        $query->execute([$titre, $image, $description, $date, $id_categorie, $id]);

        header("Location: index.php");
        exit;
    }
}

include("C:/xampp/htdocs/ISAUNNY/public/admin/article/include/header.php");
?>

<div class="container my-5">
    <h1 class="text-center mb-4" style="color: #F8FAFC;">Modifier un article</h1>

    <?php if (!empty($erreur)): ?>
        <div class="alert alert-danger text-center">
            <?= htmlspecialchars($erreur); ?>
        </div>
    <?php endif; ?>

    <form method="POST" class="w-50 mx-auto">

        <!-- TITRE -->
        <div class="mb-3">
            <input 
                type="text" 
                name="titre" 
                class="form-control"
                value="<?= htmlspecialchars($article["titre"]); ?>"
                required
            >
        </div>

        <!-- IMAGE -->
        <div class="mb-3">
            <input 
                type="text" 
                name="image" 
                class="form-control"
                value="<?= htmlspecialchars($article["image"]); ?>"
                required
            >
        </div>

        <!-- DESCRIPTION -->
        <div class="mb-3">
            <textarea 
                name="description" 
                class="form-control"
                rows="5"
                required
            ><?= htmlspecialchars($article["description"]); ?></textarea>
        </div>

        <!-- DATE -->
        <div class="mb-3">
            <input 
                type="date" 
                name="date" 
                class="form-control"
                value="<?= htmlspecialchars($article["date"]); ?>"
                required
            >
        </div>

        <!-- CATEGORIE -->
        <div class="mb-3">
            <select name="id_categorie" class="form-select" required>
                <?php foreach ($categories as $categorie): ?>
                    <option 
                        value="<?= $categorie["id_categorie"]; ?>"
                        <?= ($categorie["id_categorie"] == $article["id_categorie"]) ? "selected" : ""; ?>
                    >
                        <?= htmlspecialchars($categorie["nom"]); ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="text-center mt-4">
            <button type="submit" class="btn btn-primary" style= "background-color: #6366F1; border-radius: 999px; padding: 10px 34px;">
                Modifier 🖋️
            </button>
        </div>

    </form>
</div>

