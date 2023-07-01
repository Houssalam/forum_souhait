<?php
session_start();
require('actions/wishs/showAllWishsAction.php');

$isAdmin = false; // Initialisation de $isAdmin à false par défaut

if(isset($_SESSION['auth'])){
    if($_SESSION['role'] === "2"){
        $welcomeMsg = "Bienvenue administrateur " . $_SESSION['lastname'];
        $isAdmin = true;
    } else {
        $welcomeMsg = "Ravi de vous revoir utilisateur " . $_SESSION['lastname'];
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<?php include 'includes/head.php'; ?>
<body>
    <?php include 'includes/navbar.php'; ?>
    <br><br>

   <div class="container">

          <h1><?php echo isset($welcomeMsg) ? $welcomeMsg : ''; ?></h1>

    <!-- Votre code HTML existant -->

    <?php 
        while($wish = $getAllWishs->fetch()){
            ?>
                <div class="card">
                    <div class="card-header">
                        <a href="article.php?idliste_de_souhait=<?= $wish['idliste_de_souhait']; ?>"><?= $wish['nom']; ?>
                        </a>
                    </div>
                    <div class="card-body">
                         <?= $wish['description']; ?>
                         <br><br>
                         
                         <?php if($isAdmin): ?>
                             <!-- Afficher les fonctionnalités spécifiques aux administrateurs -->
                             <a href="article.php?idliste_de_souhait=<?= $wish['idliste_de_souhait']; ?>" class="btn btn-primary">Accéder au souhait</a>
                             <a href="edit-wish.php?idliste_de_souhait=<?= $wish['idliste_de_souhait']; ?>" class="btn btn-warning">Modifier le souhait</a>
                             <a href="actions/wishs/deleteWishAction.php?idliste_de_souhait=<?= $wish['idliste_de_souhait']; ?>" class="btn btn-danger">Supprimer le souhait</a>
                         <?php else: ?>
                             <!-- Afficher les fonctionnalités spécifiques aux utilisateurs -->
                             <a href="article.php?idliste_de_souhait=<?= $wish['idliste_de_souhait']; ?>" class="btn btn-primary">Accéder au souhait</a>
                         <?php endif; ?>
                    </div>
                    <div class="card-footer">
                        Publié par <a href="profile.php?iduser=<?= $wish['user_iduser']; ?>"><?= $wish['nom']; ?></a> le <?= $wish['date_publication']; ?>
                    </div>
                </div>
                <br>
            <?php
        }
    ?>
   </div>
</body>
</html>
