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

$query = $pdo->prepare("DELETE FROM T_COMMENTAIRE WHERE id_commentaire = ?");
$query->execute([$id]);

header("Location: index.php");
exit;