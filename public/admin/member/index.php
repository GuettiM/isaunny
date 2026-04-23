<?php
session_start();

if(!isset($_SESSION["user"]) || $_SESSION["user"]["role"] !== "admin"){
    header("Location:/ISAUNNY/public/authentificator/login.php");
    exit;
}

require_once("../../../config/database.php");

$query = $pdo->query("SELECT * FROM T_MEMBRE");
$Membres = $query->fetchAll();

include("C:/xampp/htdocs/ISAUNNY/public/admin/article/include/header.php");
?>

<body style="background-color:#0F172A;">

<div class="container my-5">
    <h1 class="text-center mb-4" style="color:#F8FAFC;">Gestion des membres</h1>

    <table class="table table-bordered table-striped table-hover text-center align-middle">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Email</th>
                <th>Mot De Passe</th>
                <th>Role</th>
                <th>Pseudo</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($Membres as $membre): ?>
                <tr>
                    <td><?= $membre["id_membre"]; ?></td>
                    <td><?= htmlspecialchars($membre["email"]); ?></td>
                    <td><?= htmlspecialchars($membre["password"]); ?></td>
                    <td><?= htmlspecialchars($membre["role"]); ?></td>
                    <td><?= htmlspecialchars($membre["pseudo"]); ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

</body>
</html>