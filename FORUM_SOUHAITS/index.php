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

        <?php 
        while($wish = $getAllWishs->fetch()){
            ?>
            <div class="card">
                <div class="card-header">
                    <?php if(isset($_SESSION['auth'])): ?>
                        <!-- Si l'utilisateur est connecté, afficher le lien vers le souhait -->
                        <a href="article.php?idliste_de_souhait=<?= $wish['idliste_de_souhait']; ?>" style="text-decoration: none;"><?= $wish['nom']; ?></a>
                    <?php else: ?>
                        <!-- Si l'utilisateur n'est pas connecté, afficher le lien de connexion -->
                        <a href="login.php" class="text-decoration-none"><?= $wish['nom']; ?></a>
                    <?php endif; ?>
                </div>
                <div class="card-body">
                    <p class="card-text"><?= $wish['description']; ?></p>
                    <br><br>
                    
                    <?php if($isAdmin): ?>
                        <!-- Afficher les fonctionnalités spécifiques aux administrateurs -->
                        <a href="article.php?idliste_de_souhait=<?= $wish['idliste_de_souhait']; ?>" class="btn btn-primary">Accéder au souhait</a>
                        <a href="edit-wish.php?idliste_de_souhait=<?= $wish['idliste_de_souhait']; ?>" class="btn btn-warning">Modifier le souhait</a>
                        <a href="actions/wishs/deleteWishAction.php?idliste_de_souhait=<?= $wish['idliste_de_souhait']; ?>" class="btn btn-danger">Supprimer le souhait</a>
                    <?php else: ?>
                        <!-- Afficher les fonctionnalités spécifiques aux utilisateurs -->
                        <?php if(isset($_SESSION['auth'])): ?>
                            <a href="article.php?idliste_de_souhait=<?= $wish['idliste_de_souhait']; ?>" class="btn btn-primary">Accéder au souhait</a>
                        <?php else: ?>
                            <a href="login.php" class="btn btn-primary">Accéder au souhait</a>
                        <?php endif; ?>
                    <?php endif; ?>
                </div>
                <div class="card-footer">
                    <?php if(isset($_SESSION['auth'])): ?>
                        <!-- Si l'utilisateur est connecté, afficher le nom de l'auteur et la date de publication -->
                        Publié par <a href="profile.php?iduser=<?= $wish['user_iduser']; ?>" style="text-decoration: none;"><?= $wish['nom']; ?></a> le <?= $wish['date_publication']; ?>
                    <?php else: ?>
                        <!-- Si l'utilisateur n'est pas connecté, afficher le lien de connexion et la date de publication -->
                        Publié par <a href="login.php" style="text-decoration: none;"><?= $wish['nom']; ?></a> le <?= $wish['date_publication']; ?>
                    <?php endif; ?>
                </div>
            </div>
            <br>
            <?php

            // Récupérer les articles associés à ce souhait
            $articlesQuery = $bdd->prepare('SELECT * FROM article
                                            INNER JOIN liste_de_souhait_has_article ON article.idarticle = liste_de_souhait_has_article.article_idarticle
                                            WHERE liste_de_souhait_has_article.liste_de_souhait_idliste_de_souhait = ?');
            $articlesQuery->execute(array($wish['idliste_de_souhait']));

            while ($article = $articlesQuery->fetch()) {
                ?>
                 <div class="card">
                     <div class="card-body">
                         <h5 class="card-title text-warning border-bottom pb-2"><?= $article['nom']; ?></h5>
                         <p class="card-text bg-info p-2"><?= $article['description']; ?></p>
                     </div>
                 </div>

                <?php
            }
        }
        ?>
    </div>
</body>
</html>
