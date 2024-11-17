<?php
// Affichage du script vulnérable de connexion

$vulnerable_code = <<<EOD
<?php

include 'db.php';

\$message = "";

if (\$_SERVER["REQUEST_METHOD"] == "POST") {
    \$username = \$_POST['username'];
    \$password = \$_POST['password'];

    // Vulnérable : Requête SQL sans protection contre l'injection
    \$sql = "SELECT * FROM users WHERE username = '\$username' AND password = '\$password'";
    \$stmt = \$pdo->query(\$sql);
    \$user = \$stmt->fetch();

    if (\$user) {
        \$message = "<div class='alert alert-success'>Connexion réussie : Bienvenue, " . htmlspecialchars(\$user['username']) . "!</div>";
    } else {
        \$message = "<div class='alert alert-danger'>Identifiants incorrects.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <!-- Intégration de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-header text-center bg-danger text-white">
                        <h3>Connexion</h3>
                    </div>
                    <div class="card-body">
                        <!-- Affichage des messages -->
                        <?php if (!empty(\$message)) echo \$message; ?>

                        <!-- Formulaire de connexion -->
                        <form method="POST" action="">
                            <div class="mb-3">
                                <label for="username" class="form-label">Nom d'utilisateur :</label>
                                <input type="text" name="username" id="username" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Mot de passe :</label>
                                <input type="password" name="password" id="password" class="form-control" required>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn bg-danger text-white">Se connecter</button>
                            </div>
                        </form>

                        <div class="card-footer text-center">
                            <a href="../index.html" class="btn btn-primary">Retour à l'accueil</a>
                        </div>
                    </div>
                </div>
                <p class="text-center text-muted mt-3">
                    <small>Exemple d'injection SQL - À des fins éducatives uniquement.</small>
                </p>
            </div>
        </div>
    </div>

    <!-- Script Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
EOD;
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Code de Connexion Vulnérable</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header text-center bg-danger text-white">
                        <h3>Code de Connexion Vulnérable</h3>
                    </div>
                    <div class="card-body">
                        <pre class="bg-dark text-white p-3"><?php echo htmlspecialchars($vulnerable_code); ?></pre>
                    </div>
                    <div class="card-footer text-center">
                        <a href="vulnerable_login.php" class="btn btn-primary">Retour</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Script Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
