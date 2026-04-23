<?php
session_start();
if (!isset($_SESSION["user"]) || $_SESSION["user"]["role"] !== "admin"){
    header("Location: /ISAUNNY/public/authentificator/login.php");
    exit;
}

require_once("../../../config/database.php");

if(!isset($_GET["id"]) || empty($_GET["id"])){
    header("Location: index.php");
    exit;
}

$id = (int) $_GET["id"];

$query = $pdo->prepare("SELECT * FROM T_CATEGORIE WHERE id_categorie = ?");
$query->execute([$id]);

$categorie = $query->fetch();
if (!$categorie) {
    header("Location: index.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $nom = trim($_POST["nom"]);

    if (!empty($nom)) {

        $query = $pdo->prepare("UPDATE T_CATEGORIE SET nom = ? WHERE id_categorie = ?");
        $query->execute([$nom, $id]);

        header("Location: index.php");
        exit;
    }

}

include("C:/xampp/htdocs/ISAUNNY/public/admin/category/include/header.php");

?>

<h1 class="text-center " style="color: #F8FAFC;">Modifier une catégorie</h1>
 <div class="container my-5">
  <?php if (!empty($erreur)): ?>
        <div class="alert alert-danger text-center">
            <?= htmlspecialchars($erreur); ?>
        </div> 
    <?php endif; ?>
<form  method="POST" class="w-50 mx-auto">
    <div class="d-flex justify-content-center mb-3">
    <input  type="text" name="nom" class="form-control" value="<?= htmlspecialchars($categorie['nom']); ?>" required>
    </div>
    <div class="text-center mt-4">
        <button type="submit"  class="btn btn-primary" style="background-color: #6366F1; border-radius: 999px; padding: 10px 34px;">Modifier🖋️</button>
    </div>
</div>
</form>







