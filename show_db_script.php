<?php
// show_db_script.php : Affichage du script de création de la base de données

$create_script = "
-- Création de la base de données
CREATE DATABASE test_db;

-- Sélectionner la base de données
USE test_db;

-- Création de la table users
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(50) NOT NULL
);

-- Ajout de quelques utilisateurs de test
INSERT INTO users (username, password) VALUES
('admin', 'admin123'),
('user1', 'password1'),
('user2', 'password2');
";
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Script de Création de la Base de Données</title>
    <!-- Intégration de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header text-center bg-info text-white">
                        <h2>Script de Création de la Base de Données</h2>
                    </div>
                    <div class="card-body">
                        <pre class="bg-dark text-white p-3"><?php echo htmlspecialchars($create_script); ?></pre>
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
