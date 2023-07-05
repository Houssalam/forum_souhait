<?php  
require('actions/users/securityAction.php'); // Inclusion de l'action pour vérifier la sécurité de l'utilisateur
require('actions/wishs/myWishsAction.php'); // Inclusion de l'action pour récupérer les souhaits de l'utilisateur connecté

// Vérifier si le message de succès est présent dans l'URL
if (isset($_GET['success'])) {
    $successMessage = $_GET['success'];
    // Afficher le message de succès à l'utilisateur en utilisant une boîte de dialogue JavaScript (alert)
    echo '<script>alert("' . $successMessage . '");</script>';
}

?>

<!DOCTYPE html>
<html lang="en">
<?php include 'includes/head.php';?> <!-- Inclusion du fichier contenant les balises <head> -->
<body>
   <?php include 'includes/navbar.php';?> <!-- Inclusion du fichier contenant la barre de navigation -->

 <br>
 <div class="container">
  <?php
    while ($wish = $getAllMyWishs->fetch()){ // Boucle pour afficher tous les souhaits de l'utilisateur connecté
     ?>
        <div class="card">
            <div class="card-header">
                <a href="article.php?idliste_de_souhait=<?= $wish['idliste_de_souhait']; ?>"><?= $wish['nom']; ?></a>
                <!-- Lien pour accéder au détail du souhait en passant son ID dans l'URL -->
            </div>
            <div class="card-body">
                <p class="card-text"><?= $wish['description']; ?></p>
                <!-- Affichage de la description du souhait -->
                
                <?php
                // Récupérer les articles associés à ce souhait
                $articlesQuery = $bdd->prepare('SELECT * FROM article
                                                INNER JOIN liste_de_souhait_has_article ON article.idarticle = liste_de_souhait_has_article.article_idarticle
                                                WHERE liste_de_souhait_has_article.liste_de_souhait_idliste_de_souhait = ?');
                $articlesQuery->execute(array($wish['idliste_de_souhait']));

                while ($article = $articlesQuery->fetch()) {
                    // Boucle pour afficher tous les articles associés au souhait
                    ?>
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><?= $article['nom']; ?></h5>
                            <!-- Affichage du nom de l'article -->
                            <p class="card-text bg-info"><?= $article['description']; ?></p>
                            <!-- Affichage de la description de l'article avec un fond coloré (background) -->
                        </div>
                    </div>
                    <?php
                }
                ?>

                <a href="article.php?idliste_de_souhait=<?= $wish['idliste_de_souhait']; ?>" class="btn btn-primary">Accéder au souhait</a>
                <!-- Bouton pour accéder au détail du souhait en passant son ID dans l'URL -->
                <a href="edit-wish.php?idliste_de_souhait=<?= $wish['idliste_de_souhait']; ?>" class="btn btn-warning">Modifier le souhait</a>
                <!-- Bouton pour modifier le souhait en passant son ID dans l'URL -->
                <a href="actions/wishs/deleteWishAction.php?idliste_de_souhait=<?= $wish['idliste_de_souhait']; ?>" class="btn btn-danger">Supprimer le souhait</a>
                <!-- Bouton pour supprimer le souhait en passant son ID dans l'URL -->
            </div>
        </div>
        <br>
      <?php
    }
  ?>
  </div>

</body>
</html>
