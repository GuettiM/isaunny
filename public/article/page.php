<?php
session_start();
require_once("../../config/database.php");

if (!isset($_GET["id"]) || empty($_GET["id"])) {
    header("Location: ../index.php");
    exit;
}

$id = (int) $_GET["id"];

$query = $pdo->prepare("
    SELECT 
        T_ARTICLE.*,
        T_CATEGORIE.nom AS categorie_nom
    FROM T_ARTICLE
    INNER JOIN T_CATEGORIE 
    ON T_ARTICLE.id_categorie = T_CATEGORIE.id_categorie
    WHERE id_article = ?

    
");

$query->execute([$id]);
$article = $query->fetch();

if (!$article) {
    header("Location: ../index.php");
    exit;
}

$erreurCommentaire = "";
$successCommentaire = "";

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_SESSION["user"])) {

    $contenu = trim($_POST["contenu"]);
    $id_membre = $_SESSION["user"]["id"];

    if (empty($contenu)) {
        $erreurCommentaire = "Le commentaire ne peut pas être vide.";
    } else {
        $queryInsertComment = $pdo->prepare("
            INSERT INTO T_COMMENTAIRE (contenu, date_commentaire, statut, id_article, id_membre)
            VALUES (?, NOW(), 'en_attente', ?, ?)
        ");
        $queryInsertComment->execute([$contenu, $id, $id_membre]);

        $successCommentaire = "Votre commentaire a bien été envoyé et est en attente de validation.";
    }
}

$queryComments = $pdo->prepare("
    SELECT 
        T_COMMENTAIRE.*,
        T_MEMBRE.pseudo
    FROM T_COMMENTAIRE
    INNER JOIN T_MEMBRE ON T_COMMENTAIRE.id_membre = T_MEMBRE.id_membre
    WHERE T_COMMENTAIRE.id_article = ? AND T_COMMENTAIRE.statut = 'valide'
    ORDER BY T_COMMENTAIRE.date_commentaire DESC
");
$queryComments->execute([$id]);
$comments = $queryComments->fetchAll();
include("c:/xampp/htdocs/ISAUNNY/public/include/header.php");
?>

<!---------------------------------------ARTICLE------------------------------------------>
<div class="container my-5">

    <h1 class="text-center mb-4" style="color: #F8FAFC;"><?= htmlspecialchars($article["titre"]); ?></h1>

    <div class="text-center mb-4">
        <img src="../img/<?= htmlspecialchars($article["image"]); ?>" class="img-fluid" style="max-height: 400px;">
    </div>

    <p class="text-center " style="color: #CBD5E1;">
        Catégorie : <?= htmlspecialchars($article["categorie_nom"]); ?> |
        Date : <?= htmlspecialchars($article["date"]); ?>
    </p>

    <div class="mt-4" style="color: #F8FAFC;">
        <?= nl2br(htmlspecialchars($article["description"])); ?>
    </div>

</div>

<!--------------COMMENTAIRE----------------->
<div class="container my-5">
    <h3 class="mb-4" style="color: #F8FAFC;">Commentaires</h3>

    <?php if (!empty($comments)): ?>
        <?php foreach ($comments as $comment): ?>
            <div class="p-3 mb-3 rounded" style="background-color: rgba(255,255,255,0.05); color: #F8FAFC;">
                <p class="mb-1 fw-bold">
                    <?= htmlspecialchars($comment["pseudo"]); ?>
                </p>
                <p class="mb-2" style="font-size: 0.9rem; color: #CBD5E1;">
                    <?= date("d/m/Y H:i", strtotime($comment["date_commentaire"])); ?>
                </p>
                <p class="mb-0">
                    <?= nl2br(htmlspecialchars($comment["contenu"])); ?>
                </p>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p style="color: #CBD5E1;">Aucun commentaire validé pour le moment.</p>
    <?php endif; ?>
</div>

<div class="container my-5">
    <h3 class="mb-4" style="color: #F8FAFC;">Laisser un commentaire</h3>

    <?php if (!empty($erreurCommentaire)): ?>
        <div class="alert alert-danger">
            <?= htmlspecialchars($erreurCommentaire); ?>
        </div>
    <?php endif; ?>

    <?php if (!empty($successCommentaire)): ?>
        <div class="alert alert-success">
            <?= htmlspecialchars($successCommentaire); ?>
        </div>
    <?php endif; ?>

    <?php if (isset($_SESSION["user"])): ?>
        <form method="POST">
            <div class="mb-3">
                <textarea 
                    name="contenu" 
                    class="form-control" 
                    rows="5" 
                    placeholder="Écrivez votre commentaire ici..."
                    required
                ></textarea>
            </div>

            <button type="submit" class="btn btn-primary" style="background-color: #6366F1; border-radius: 999px; padding: 10px 34px;">
                Envoyer
            </button>
        </form>
    <?php else: ?>
        <p style="color: #CBD5E1;">
            Vous devez être connecté pour laisser un commentaire.
        </p>
        <a href="/ISAUNNY/public/authentificator/login.php" class="btn btn-light">
            Se connecter
        </a>
    <?php endif; ?>
</div>
<?php
include("c:/xampp/htdocs/ISAUNNY/public/include/footer.php"); 
?>