<?php
session_start();
require('actions/database.php');

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['iduser'])) {
    // Rediriger vers la page de connexion ou afficher un message d'erreur
    header('Location: login.php');
    exit;
}

// Récupérer l'ID du souhait à partager depuis l'URL
if (isset($_GET['idliste_de_souhait'])) {
    $idliste_de_souhait = $_GET['idliste_de_souhait'];
} else {
    // Rediriger vers la page d'erreur ou afficher un message d'erreur
    header('Location: shareError.php');
    exit;
}

// Récupérer la liste des utilisateurs disponibles pour le partage
$getUsers = $bdd->query('SELECT iduser, nom FROM user');

?>

<!DOCTYPE html>
<html lang="en">

<?php include('includes/head.php');?>

<body>
    <?php include('includes/navbar.php');?>
    <br><br>

    <div class="container">
        <h3>Sélectionnez les utilisateurs pour partager le souhait</h3>
        
        <form action="shareProcess.php" method="POST">
            
             <button type="submit" class="btn btn-primary">Partager</button>

            <input type="hidden" name="idliste_de_souhait" value="<?= $idliste_de_souhait; ?>">
            
            <div class="row">
                <?php while ($user = $getUsers->fetch()) { ?>
                    <div class="col-md-6">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="users[]" value="<?= $user['iduser']; ?>">
                            <label class="form-check-label"><?= $user['nom']; ?></label>
                        </div>
                    </div>
                <?php } ?>
            </div>

            <br>
            
            
        </form>
    </div>
</body>

</html>

