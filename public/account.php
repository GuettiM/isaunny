<?php
session_start();

if (!isset($_SESSION["user"])) {
    header("Location: /ISAUNNY/public/authentificator/login.php");
    exit;
}

require_once("../config/database.php");

$id = $_SESSION["user"]["id"];
$erreur = "";
$success = "";

/* Récupérer l'utilisateur actuel */
$query = $pdo->prepare("SELECT * FROM T_MEMBRE WHERE id_membre = ?");
$query->execute([$id]);
$user = $query->fetch();

if (!$user) {
    header("Location: /ISAUNNY/public/authentificator/logout.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $pseudo = trim($_POST["pseudo"]);
    $email = trim($_POST["email"]);

    if (empty($pseudo) || empty($email)) {
        $erreur = "Tous les champs sont obligatoires.";
    } else {
        /* Vérifier si l'email est déjà utilisé par un autre compte */
        $checkEmail = $pdo->prepare("SELECT * FROM T_MEMBRE WHERE email = ? AND id_membre != ?");
        $checkEmail->execute([$email, $id]);
        $existingUser = $checkEmail->fetch();

        if ($existingUser) {
            $erreur = "Cet email est déjà utilisé par un autre compte.";
        } else {
            $queryUpdate = $pdo->prepare("UPDATE T_MEMBRE SET pseudo = ?, email = ? WHERE id_membre = ?");
            $queryUpdate->execute([$pseudo, $email, $id]);

            /* Mettre à jour la session */
            $_SESSION["user"]["pseudo"] = $pseudo;
            $_SESSION["user"]["email"] = $email;

            $success = "Vos informations ont bien été mises à jour.";

            /* Recharger les infos */
            $query = $pdo->prepare("SELECT * FROM T_MEMBRE WHERE id_membre = ?");
            $query->execute([$id]);
            $user = $query->fetch();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>compte - I.sAunny</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .log-btn{
            color: #0F172A;
            border-radius: 999px;
            font-weight: bold;
        }
        .log-btn2{
            color: #F8FAFC;
            border-radius: 999px;
            font-weight: bold;
        }
    </style>
</head>
<body style="background-color:#0F172A; color:#F8FAFC;">

<nav class="navbar navbar-expand-lg" style="background-color:#6366F1;">
    <div class="container">
        <a class="navbar-brand text-white fw-bold" href="/ISAUNNY/public/index.php">I.sAunny</a>

        <div class="d-flex align-items-center">
            <span class="text-white me-3">
                <?= htmlspecialchars($_SESSION["user"]["pseudo"]); ?>
            </span>

            <a href="/ISAUNNY/public/index.php" class="btn btn-light btn-sm me-2 log-btn">
                Blog 
            </a>

            <?php if ($_SESSION["user"]["role"] === "admin"): ?>
                <a href="/ISAUNNY/public/admin/index.php" class="btn btn-warning btn-sm me-2 log-btn">
                    Admin
                </a>
            <?php endif; ?>

            <a href="/ISAUNNY/public/authentificator/logout.php" class="btn btn-danger btn-sm log-btn2">
                Déconnexion
            </a>
        </div>
    </div>
</nav>

<div class="container my-5">
    <h1 class="text-center mb-4">Gestion du compte</h1>

    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6">

            <div class="card shadow" style="background-color: #6366F1; color: #F8FAFC;">
                <div class="card-body p-4">

                    <?php if (!empty($erreur)): ?>
                        <div class="alert alert-danger">
                            <?= htmlspecialchars($erreur); ?>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($success)): ?>
                        <div class="alert alert-success">
                            <?= htmlspecialchars($success); ?>
                        </div>
                    <?php endif; ?>

                    <form method="POST">
                        <div class="mb-3">
                            <label for="pseudo" class="form-label">Pseudo</label>
                            <input 
                                type="text" 
                                name="pseudo" 
                                id="pseudo" 
                                class="form-control"
                                value="<?= htmlspecialchars($user["pseudo"]); ?>"
                                required
                            >
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input 
                                type="email" 
                                name="email" 
                                id="email" 
                                class="form-control"
                                value="<?= htmlspecialchars($user["email"]); ?>"
                                required
                            >
                        </div>

                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-primary" style="background-color: #111827; border:none; border-radius:999px; padding:10px 34px;">
                                Mettre à jour
                            </button>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>

</body>
</html>