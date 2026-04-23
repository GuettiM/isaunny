<?php
session_start();

if (!isset($_SESSION["user"]) || $_SESSION["user"]["role"] !== "admin"){
    header("Location: /ISAUNNY/public/authentificator/login.php");
    exit;
}

require_once("../../../config/database.php");
$query = $pdo->query("SELECT * FROM T_ARTICLE INNER JOIN T_CATEGORIE ON T_ARTICLE.id_categorie = T_CATEGORIE.id_categorie
    ORDER BY T_ARTICLE.id_article DESC
");
$articles = $query->fetchAll();



include("C:/xampp/htdocs/ISAUNNY/public/admin/article/include/header.php");
?>
<div class="container my-5">
    <div class="d-flex justify-content-center align-items-center mb-4">
        <h1 class="m-0" style="color: #F8FAFC;">Gestion des articles</h1>
        
    </div>

    <table class="table table-bordered table-striped table-hover text-center align-middle">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Titre</th>
                <th>Image</th>
                <th>Description</th>
                <th>Date</th>
                <th>Catégorie</th>
                <th>Actions</th>
            </tr>
        </thead>
<tbody>
    <?php foreach ($articles as $article): ?>
        <tr>
            <td><?php echo $article["id_article"]; ?></td>
            <td><?php echo htmlspecialchars($article["titre"]); ?></td>
            <td><?php echo htmlspecialchars($article["image"]); ?></td>
            <td><?php echo htmlspecialchars($article["description"]); ?></td>
            <td><?php echo htmlspecialchars($article["date"]); ?></td>
            <td><?php echo htmlspecialchars($article["nom"]); ?></td>
            <td>
                <a href="edit.php?id=<?php echo $article["id_article"]; ?>" class="btn btn-warning btn-sm">
                            Modifier
                </a>
                <a href="delete.php?id=<?php echo $article["id_article"]; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Voulez-vous vraiment supprimer cet article ?');">
                            Supprimer
                </a>
            </td>
        </tr>
    <?php endforeach; ?>
</tbody>
    </table>
    <div class="text-center mt-4">
    <a href="create.php" class="btn btn-primary" style="background-color: #6366F1; border-radius: 999px; padding: 10px 34px;">
            Ajouter ➕
        </a>
    </div>
</div>