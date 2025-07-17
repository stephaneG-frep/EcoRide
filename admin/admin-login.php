<?php
error_reporting(-1);
ini_set("display_errors", 1);

session_start();
require_once "../db/Database.php";
require_once "database_admin.php";
require_once "Admin.php";

// Redirection si déjà connecté
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header('Location: admin.php');
    exit();
}

// Traitement du formulaire
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    if (empty($username) || empty($password)) {
        $error = 'Tous les champs sont obligatoires';
    } else {
        try {
            $admin = new Admin();
            $admin->getDBConnection($username);
            //$db->getConnexion();
            /*
            $db = getDBConnection();
            $stmt = $db->prepare("SELECT * FROM admin_users WHERE username = ? LIMIT 1");
            $stmt->execute([$username]);
            $admin = $stmt->fetch();
            

            if ($admin && password_verify($password, $admin['password'])) {
                // Connexion réussie
                $_SESSION['admin_logged_in'] = true;
                $_SESSION['admin_id'] = $admin['id'];
                $_SESSION['admin_username'] = $admin['username'];
            */
            if ($username && password_verify($password, $username['password'])) {
                    // Connexion réussie
                $_SESSION['admin_logged_in'] = true;
                $_SESSION['admin_id'] = $username['id'];
                $_SESSION['admin_username'] = $username['username'];
                    
                
                // Régénération de l'ID de session pour éviter le fixation
                session_regenerate_id(true);
                
                header('Location: admin.php');
                exit();
            } else {
                $error = 'Identifiants incorrects';
                // Délai artificiel pour contrer les attaques par force brute
                sleep(1);
            }
        } catch (PDOException $e) {
            error_log('Admin login error: ' . $e->getMessage());
            $error = 'Erreur système. Veuillez réessayer.';
        }
        
  }
        
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ecoride - Connexion Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .login-container {
            max-width: 400px;
            margin: 100px auto;
            padding: 30px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }
        .login-logo {
            text-align: center;
            margin-bottom: 30px;
        }
        .login-logo img {
            max-width: 150px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="login-container">
            <div class="login-logo">
                <img src="../assets/img/ecoride-logo.png" alt="Ecoride Logo">
                <h2 class="mt-3">Espace Administrateur</h2>
            </div>

            <?php if (!empty($error)): ?>
                <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
            <?php endif; ?>

            <form method="POST" action="">
                <div class="mb-3">
                    <label for="username" class="form-label">Nom d'utilisateur</label>
                    <input type="text" class="form-control" id="username" name="username" required autofocus>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Mot de passe</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <div class="d-grid gap-2">
                    <button type="submit" class="btn btn-primary">Se connecter</button>
                </div>
            </form>

            <div class="mt-3 text-center">
                <a href="../index.php" class="text-decoration-none">← Retour au site public</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>