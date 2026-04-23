<?php
session_start();

if (!isset($_SESSION["user"]) || $_SESSION["user"]["role"] !== "admin") {
    header("Location: /ISAUNNY/public/authentificator/login.php");
    exit;
}

require_once("../../../config/database.php");

$id = (int) $_GET["id"];

$query = $pdo->prepare("UPDATE T_COMMENTAIRE SET statut = 'valide' WHERE id_commentaire = ?");
$query->execute([$id]);

header("Location: index.php");
exit;
