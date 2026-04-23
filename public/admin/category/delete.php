<?php
session_start();
if (!isset($_SESSION["user"]) || $_SESSION["user"]["role"] !== "admin"){
    header("Location: /ISAUNNY/public/authentificator/login.php");
    exit;
}

require_once("../../../config/database.php");

if (isset($_GET["id"]) && !empty($_GET["id"])) {
    $id = (int) $_GET["id"];

    $query = $pdo->prepare("DELETE FROM T_CATEGORIE WHERE id_categorie = ?");
    $query->execute([$id]);
}

header("Location: index.php");
exit;