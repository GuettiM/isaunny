<?php
session_start();
require_once("../../config/database.php");

$erreur = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email = trim($_POST["email"]);
    $password = trim($_POST["password"]);

    if (empty($email) || empty($password)) {
        $erreur = "Tous les champs sont obligatoires.";
    } else {

        $query = $pdo->prepare("SELECT * FROM T_MEMBRE WHERE email = ?");
        $query->execute([$email]);
        $user = $query->fetch();

        if ($user && password_verify($password, $user["password"])) {

            $_SESSION["user"] = [
                "id" => $user["id_membre"],
                "pseudo" => $user["pseudo"],
                "email" => $user["email"],
                "role" => $user["role"]
            ];

            header("Location: ../index.php");
            exit;

        } else {
            $erreur = "Email ou mot de passe incorrect.";
        }
    }
}



include("C:/xampp/htdocs/ISAUNNY/public/authentificator/include/header.php")
?>

<body>

<div class="login-wrapper">
    <div class="login-card">

        <h1 class="login-title">Connexion</h1>

        <?php if (!empty($erreur)): ?>
            <div class="alert alert-danger text-center">
                <?= htmlspecialchars($erreur); ?>
            </div>
        <?php endif; ?>

        <form method="POST">

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
                <button type="submit" class="btn btn-login">
                    Connexion
                </button>
            </div>

            <div class="text-center mt-4">
                <a href="register.php" class="login-link">Pas encore de compte ? S'inscrire</a>
            </div>

        </form>
    </div>
</div>

</body>
<?php 
include("C:/xampp/htdocs/ISAUNNY/public/authentificator/include/footer.php");
?>