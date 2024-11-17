<?php
// Affichage du script vulnérable de connexion

$vulnerable_code = <<<EOD
<?php
// safe_search.php : Version sécurisée de la recherche d'utilisateur

// http://localhost:8000/recuperation/vulnerable_recuperation_safe.php
// username=admin%27%20UNION%20SELECT%20id,%20password%20FROM%20users%20;--

include 'db.php';

\$results = "";

if (\$_SERVER["REQUEST_METHOD"] == "GET" && isset(\$_GET['username'])) {
    \$username = \$_GET['username'];

    // Sécurisé : Utilisation de requêtes préparées
    \$sql = "SELECT id, username FROM users WHERE username = :username";
    \$stmt = \$pdo->prepare(\$sql);

    // Liaison des paramètres
    \$stmt->bindParam(':username', \$username, PDO::PARAM_STR);
    \$stmt->execute();

    // Affichage des résultats
    \$data = \$stmt->fetchAll();
    if (\$data) {
        foreach (\$data as \$row) {
            \$results .= "<div class='alert alert-success'>"
                . "<strong>ID :</strong> " . htmlspecialchars(\$row['id']) . "<br>"
                . "<strong>Nom d'utilisateur :</strong> " . htmlspecialchars(\$row['username']) 
                . "</div>";
        }
    } else {
        \$results .= "<div class='alert alert-warning'>Aucun utilisateur trouvé pour ce nom.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recherche d'utilisateur sécurisée</title>
    <!-- Intégration de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header text-center bg-success text-white">
                        <h3>Recherche d'utilisateur sécurisée</h3>
                    </div>
                    <div class="card-body">
                        <form method="GET" action="">
                            <div class="mb-3">
                                <label for="username" class="form-label">Nom d'utilisateur :</label>
                                <input type="text" name="username" id="username" class="form-control" required>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn bg-success text-white">Rechercher</button>
                            </div>
                        </form>

                        <div class="card-footer text-center">
                            <a href="../index.html" class="btn btn-primary">Retour à l'accueil</a>
                            <a href="show_recuperation_safe_script.php" class="btn btn-primary">Voir le script de recuperation safe</a>
                        </div>
                    </div>
                </div>
                <div class="mt-4">
                    <!-- Résultats de la recherche -->
                    <?php echo \$results; ?>
                </div>
                <p class="text-center text-muted mt-3">
                    <small>Récupération sécurisée avec requêtes préparées.</small>
                </p>

                <br><br>

                <!-- Zone de contenu dynamique (écrire quelque chose ici) -->
                <div class="card mt-4">
                    <div class="card-header bg-warning text-white">
                        <h5>Le test : </h5>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-info">
                            <strong>Pour le test</strong>, il faut tout simplement mettre après le lien dans la bare de recherche : <br><code>?username=admin%27%20UNION%20SELECT%20id,%20password%20FROM%20users%20;--</code>
                            <br><br>
                            <strong>Résultat :</strong><br> <code>SELECT id, username FROM users WHERE username = '\$username'</code> <br>
                            <strong>?username=admin</strong> <code>SELECT id, username FROM users WHERE username = 'admin'</code> <br>
                            <strong>?username=admin%27%20UNION%20SELECT%20id,%20password%20FROM%20users%20;--</strong> <br> <code>SELECT id, username FROM users WHERE username = '(admin' UNION SELECT id, password FROM users ;--)'</code> <br><br>
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
    <title>Code de recherche d'utilisateur sécurisé</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header text-center bg-success text-white">
                        <h3>Code de recherche d'utilisateur sécurisé</h3>
                    </div>
                    <div class="card-body">
                        <pre class="bg-dark text-white p-3"><?php echo htmlspecialchars($vulnerable_code); ?></pre>
                    </div>
                    <div class="card-footer text-center">
                    <a href="vulnerable_recuperation_safe.php" class="btn btn-primary">Retour</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Script Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
