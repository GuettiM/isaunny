<?php
session_start();

if (!isset($_SESSION["user"]) || $_SESSION["user"]["role"] !== "admin") {
    header("Location: /ISAUNNY/public/authentificator/login.php");
    exit;
}

require_once("../../../config/database.php");

if (!isset($_GET["id"]) || empty($_GET["id"])) {
    header("Location: index.php");
    exit;
}

$id = (int) $_GET["id"];

/* Vérifier que l'article existe */
$query = $pdo->prepare("SELECT * FROM T_ARTICLE WHERE id_article = ?");
$query->execute([$id]);
$article = $query->fetch();

if (!$article) {
    header("Location: index.php");
    exit;
}

/* Supprimer */
$query = $pdo->prepare("DELETE FROM T_ARTICLE WHERE id_article = ?");
$query->execute([$id]);

header("Location: index.php");
exit;