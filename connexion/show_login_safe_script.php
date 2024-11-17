<?php
// Affichage du script vulnérable de connexion

$vulnerable_code = <<<EOD
<?php
// safe_login.php : version sécurisée du script de connexion

include 'db.php';

\$message = "";

if (\$_SERVER["REQUEST_METHOD"] == "POST") {
    \$username = \$_POST['username'];
    \$password = \$_POST['password'];

    // Sécurisé : Utilisation de requêtes préparées
    \$sql = "SELECT * FROM users WHERE username = :username AND password = :password";
    \$stmt = \$pdo->prepare(\$sql);

    // Liaison des paramètres pour éviter l'injection
    \$stmt->bindParam(':username', \$username, PDO::PARAM_STR);
    \$stmt->bindParam(':password', \$password, PDO::PARAM_STR);
    \$stmt->execute();

    // Vérification des résultats
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
    <title>Connexion Sécurisée</title>
    <!-- Intégration de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-header text-center bg-success text-white">
                        <h3>Connexion Sécurisée</h3>
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
                                <button type="submit" class="btn btn-success">Se connecter</button>
                            </div>
                        </form>

                        <div class="card-footer text-center">
                            <a href="../index.html" class="btn btn-primary">Retour à l'accueil</a>
                            <a href="show_login_safe_script.php" class="btn btn-info">Voir le Script de login safe</a>
                        </div>
                    </div>
                </div>
                <p class="text-center text-muted mt-3">
                    <small>Connexion sécurisée avec requêtes préparées.</small>
                </p>

                <br><br>

                <!-- Zone de contenu dynamique (écrire quelque chose ici) -->
                <div class="card mt-4">
                    <div class="card-header bg-warning text-white">
                        <h5>Les tests : </h5>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-info">
                            <strong>1er test :</strong> Pour le premier test, nous pouvons mettre dans le Nom d'utilisateur : <code>admin' ;--</code>
                            <br><br>
                            <strong>Résultat :</strong><br> <code>SELECT * FROM users WHERE username = '\$username' AND password = '\$password';</code> <br><br> <code>SELECT * FROM users WHERE username = 'admin' ;--' AND password = '';</code>
                        </div>
                        <div class="alert alert-info">
                            <strong>2e test :</strong> Pour le deuxième test, nous pouvons mettre dans le Nom d'utilisateur : <code>admin' OR '1'='1</code>
                            <br><br>
                            <strong>Résultat :</strong><br> <code>SELECT * FROM users WHERE username = '\$username' AND password = '\$password';</code> <br><br> <code>SELECT * FROM users WHERE username = 'admin' OR '1'='1' AND password = '';</code> <br><br> <code>SELECT * FROM users WHERE username = '(admin' OR '1'='1)' AND password = '';</code>
                        </div>
                    </div>
                </div>
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
    <title>Code de Connexion sécurisé</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header text-center bg-success text-white">
                        <h3>Code de Connexion sécurisé</h3>
                    </div>
                    <div class="card-body">
                        <pre class="bg-dark text-white p-3"><?php echo htmlspecialchars($vulnerable_code); ?></pre>
                    </div>
                    <div class="card-footer text-center">
                        <a href="vulnerable_login_safe.php" class="btn btn-primary">Retour</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Script Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
