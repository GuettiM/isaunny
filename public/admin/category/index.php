<?php
session_start();
if (!isset($_SESSION["user"]) || $_SESSION["user"]["role"] !== "admin"){
    header("Location: /ISAUNNY/public/authentificator/login.php");
    exit;
}

require_once("../../../config/database.php");
$query = $pdo->query("SELECT * FROM T_CATEGORIE");
$categories = $query->fetchAll();



include("C:/xampp/htdocs/ISAUNNY/public/admin/category/include/header.php");
?>

<h1 class="text-center" style="color: #F8FAFC;">Gestion de catégorie</h1>

<!-- MAIN -->
 <div class="container my-5">
    <table class="table table-bordered table-striped table-hover text-center align-middle">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($categories as $categorie): ?>
                <tr>
                    <td><?php echo $categorie['id_categorie']; ?></td>
                    <td><?php echo htmlspecialchars($categorie['nom']); ?></td>
                    <td>
                         <a href="edit.php?id=<?php echo $categorie['id_categorie']; ?>" class="btn btn-warning btn-sm" style="border-radius: 999px; padding: 10px 34px;">Modifier🖋️</a>
                        
                        <a href="delete.php?id=<?php echo $categorie['id_categorie']; ?>" class="btn btn-danger btn-sm" style="border-radius: 999px; padding: 10px 34px;" onclick="return confirm('Voulez-vous vraiment supprimer cette catégorie ?');">Supprimer🗑️</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
 </div>
    <div class="text-center mt-4">
        <a href="create.php" class="btn btn-primary" style="background-color: #6366F1; border-radius: 999px; padding: 10px 34px;">Ajouter➕</a>
    </div>




        