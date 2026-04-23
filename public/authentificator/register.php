<?php
require_once("../../config/database.php");
require_once("../../config/mail.php");

$erreur = "";
$success = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $pseudo = trim($_POST["pseudo"]);
    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    if (empty($pseudo) || empty($email) || empty($password)) {
        $erreur = "Tous les champs sont obligatoires.";
    } else {

        $checkEmail = $pdo->prepare("SELECT * FROM T_MEMBRE WHERE email = ?");
        $checkEmail->execute([$email]);
        $user = $checkEmail->fetch();

        if ($user) {
            $erreur = "Cet email existe déjà.";
        } else {
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);

            $query = $pdo->prepare("INSERT INTO T_MEMBRE (pseudo, email, password, role) VALUES (?, ?, ?, ?)");
            $query->execute([$pseudo, $email, $passwordHash, "membre"]);

           if (sendWelcomeEmail($email, $pseudo)) {
    $success = "Inscription réussie. Email de bienvenue envoyé.";
        } else {
    $success = "Inscription réussie, mais l'email n'a pas pu être envoyé.";
        }
        }

        
    }
}

include("C:/xampp/htdocs/ISAUNNY/public/authentificator/include/header.php")
?>

<body>

    <div class="register-wrapper">
        <div class="register-card">

            <h1 class="register-title">Inscription</h1>

            <?php if (!empty($erreur)): ?>
                <div class="alert alert-danger text-center">
                    <?= htmlspecialchars($erreur); ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($success)): ?>
                <div class="alert alert-success text-center">
                    <?= htmlspecialchars($success); ?>
                </div>
            <?php endif; ?>

            <form method="POST">

                <div class="mb-4">
                    <input 
                        type="text" 
                        name="pseudo" 
                        class="form-control custom-input" 
                        placeholder="Pseudo"
                        value="<?= isset($_POST['pseudo']) ? htmlspecialchars($_POST['pseudo']) : ''; ?>"
                        required
                    >
                </div>

                <div class="mb-4">
                    <input 
                        type="email" 
                        name="email" 
                        class="form-control custom-input" 
                        placeholder="E-mail"
                        value="<?= isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>"
                        required
                    >
                </div>

                <div class="mb-4">
                    <input 
                        type="password" 
                        name="password" 
                        class="form-control custom-input" 
                        placeholder="Password"
                        required
                    >
                </div>

                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-register">
                        S'inscrire
                    </button>
                </div>

                <div class="text-center mt-4">
                    <a href="login.php" class="register-link">Déjà un compte ? Se connecter</a>
                </div>

            </form>
        </div>
    </div>

</body>
</html>

<?php

include("C:/xampp/htdocs/ISAUNNY/public/authentificator/include/footer.php");
?>