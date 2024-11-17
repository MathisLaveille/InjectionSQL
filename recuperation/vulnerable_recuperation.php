<?php
// vulnerable_search.php : Exemple de recherche vulnérable

// http://localhost:8000/recuperation/vulnerable_recuperation.php
// username=admin%27%20UNION%20SELECT%20id,%20password%20FROM%20users%20;--

include 'db.php';

$results = "";

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['username'])) {
    $username = $_GET['username'];

    // Vulnérable : Requête SQL directe avec concaténation
    $sql = "SELECT id, username FROM users WHERE username = '$username'";
    $stmt = $pdo->query($sql);

    while ($row = $stmt->fetch()) {
        $results .= "<div class='alert alert-info'>"
            . "<strong>ID :</strong> " . htmlspecialchars($row['id']) . "<br>"
            . "<strong>Nom d'utilisateur :</strong> " . htmlspecialchars($row['username']) 
            . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recherche d'utilisateur</title>
    <!-- Intégration de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header text-center bg-danger text-white">
                        <h3>Recherche d'utilisateur</h3>
                    </div>
                    <div class="card-body">
                        <form method="GET" action="">
                            <div class="mb-3">
                                <label for="username" class="form-label">Nom d'utilisateur :</label>
                                <input type="text" name="username" id="username" class="form-control" required>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn bg-danger text-white">Rechercher</button>
                            </div>
                        </form>

                        <div class="card-footer text-center">
                            <a href="../index.html" class="btn btn-primary">Retour à l'accueil</a>
                        </div>
                    </div>
                </div>
                <div class="mt-4">
                    <!-- Résultats de la recherche -->
                    <?php 
                    if (!empty($results)) {
                        echo $results;
                    } else if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['username'])) {
                        echo "<div class='alert alert-danger'>Aucun résultat trouvé.</div>";
                    }
                    ?>
                </div>
                <p class="text-center text-muted mt-3">
                    <small>Exemple d'injection SQL - À des fins éducatives uniquement.</small>
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
