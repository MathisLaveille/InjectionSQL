<?php
// Affichage du script vulnérable de connexion

$vulnerable_code = <<<EOD
<?php
// db.php : fichier de connexion
\$host = 'localhost';
\$dbname = 'test_db';
\$username = 'root';
\$password = 'root';

try {
    \$pdo = new PDO("mysql:host=\$host;dbname=\$dbname", \$username, \$password);
    \$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException \$e) {
    die("Erreur de connexion : " . \$e->getMessage());
}
?>
EOD;
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Code de Connexion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header text-center bg-info text-white">
                        <h3>Code de Connexion</h3>
                    </div>
                    <div class="card-body">
                        <pre class="bg-dark text-white p-3"><?php echo htmlspecialchars($vulnerable_code); ?></pre>
                    </div>
                    <div class="card-footer text-center">
                    <a href="index.html" class="btn btn-primary">Retour à l'accueil</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Script Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
