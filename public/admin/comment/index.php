<?php
session_start();

if (!isset($_SESSION["user"]) || $_SESSION["user"]["role"] !== "admin") {
    header("Location: /ISAUNNY/public/authentificator/login.php");
    exit;
}

require_once("../../../config/database.php");

$query = $pdo->query("
    SELECT 
        T_COMMENTAIRE.*,
        T_MEMBRE.pseudo,
        T_ARTICLE.titre
    FROM T_COMMENTAIRE
    INNER JOIN T_MEMBRE ON T_COMMENTAIRE.id_membre = T_MEMBRE.id_membre
    INNER JOIN T_ARTICLE ON T_COMMENTAIRE.id_article = T_ARTICLE.id_article
    ORDER BY T_COMMENTAIRE.date_commentaire DESC
");

$commentaires = $query->fetchAll();
include("C:/xampp/htdocs/ISAUNNY/public/admin/article/include/header.php");
?>


<body style="background-color:#0F172A;">

<div class="container my-5">
    <h1 class="text-center mb-4" style="color:#F8FAFC;">Gestion des commentaires</h1>

    <table class="table table-bordered table-striped table-hover text-center align-middle">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Auteur</th>
                <th>Article</th>
                <th>Contenu</th>
                <th>Date</th>
                <th>Statut</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($commentaires as $commentaire): ?>
                <tr>
                    <td><?= $commentaire["id_commentaire"]; ?></td>
                    <td><?= htmlspecialchars($commentaire["pseudo"]); ?></td>
                    <td><?= htmlspecialchars($commentaire["titre"]); ?></td>
                    <td><?= htmlspecialchars($commentaire["contenu"]); ?></td>
                    <td><?= htmlspecialchars($commentaire["date_commentaire"]); ?></td>
                    <td><?= htmlspecialchars($commentaire["statut"]); ?></td>
                    <td>
                        <?php if ($commentaire["statut"] !== "valide"): ?>
                            <a href="validate.php?id=<?= $commentaire["id_commentaire"]; ?>" class="btn btn-success btn-sm">
                                Valider
                            </a>
                        <?php endif; ?>

                        <a href="delete.php?id=<?= $commentaire["id_commentaire"]; ?>" 
                           class="btn btn-danger btn-sm"
                           onclick="return confirm('Voulez-vous vraiment supprimer ce commentaire ?');">
                            Supprimer
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

</body>
</html>