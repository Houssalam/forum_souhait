<?php
session_start();
require('actions/database.php');

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['iduser'])) {
    // Rediriger vers la page de connexion ou afficher un message d'erreur
    header('Location: login.php');
    exit;
}

// Vérifier si le partage a réussi
if (isset($_SESSION['share_success']) && $_SESSION['share_success']) {
    $message = "Le souhait a été partagé avec succès !";
} else {
    $message = "Une erreur s'est produite lors du partage du souhait.";
}

// Effacer la variable de session
unset($_SESSION['share_success']);
?>

<!DOCTYPE html>
<html lang="en">

<?php include('includes/head.php'); ?>

<body>
    <?php include('includes/navbar.php'); ?>
    <br><br>

    <div class="container">
        <div class="card">
            <div class="card-body">
                <h3>Partage de souhait</h3>
                <hr>
                <div class="alert alert-<?php echo isset($_SESSION['share_success']) && $_SESSION['share_success'] ? 'success' : 'danger'; ?>" role="alert">
                    <?php echo $message; ?>
                </div>
                <a href="profile.php?iduser=<?= $_SESSION['iduser']; ?>" class="btn btn-primary">Retour au profil</a>
            </div>
        </div>
    </div>
</body>

</html>
