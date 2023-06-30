<?php 
session_start();
require('actions/wishs/showAllWishsAction.php');

if(isset($_SESSION['auth'])){
    
    if($_SESSION['role'] === "2"){
        $welcomeMsg = "Bienvenue administrateur " . $_SESSION['lastname'];
        $isAdmin = true;
    } else {
        $welcomeMsg = "Ravi de vous revoir utilisateur " . $_SESSION['lastname'];
        $isAdmin = false;
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

    <form method="GET">
        <div class="form-group row">
            <div class="col-8">
                <input type="search" name="search" class="form-control">
            </div>
            <div class="col-4">
                <button class="btn btn-success" type="submit">Rechercher</button>
            </div>
        </div>
    </form>
    
    <br>

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
                             <a href="article.php?idliste_de_souhait=<?= $wish['idliste_de_souhait']; ?>" class="btn btn-primary">Accéder au souhait</a>
                             <a href="edit-wish.php?idliste_de_souhait=<?= $wish['idliste_de_souhait']; ?>" class="btn btn-warning">Modifier le souhait</a>
                             <a href="actions/wishs/deleteWishAction.php?idliste_de_souhait=<?= $wish['idliste_de_souhait']; ?>" class="btn btn-danger">Supprimer le souhait</a>
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
