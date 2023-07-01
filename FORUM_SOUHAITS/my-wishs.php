<?php  
  require('actions/users/securityAction.php');
  require('actions/wishs/myWishsAction.php'); 

// Vérifier si le message de succès est présent dans l'URL
if (isset($_GET['success'])) {
    $successMessage = $_GET['success'];
    // Afficher le message de succès à l'utilisateur
    echo '<script>alert("' . $successMessage . '");</script>';
}
// Le reste du code de la page my-wishs.php
// ...



?>

<!DOCTYPE html>
<html lang="en">
<?php include 'includes/head.php';?>
<body>
   <?php include 'includes/navbar.php';?>

 <br><br>
 <div class="container">
  <?php
    while ($wish = $getAllMyWishs->fetch()){
     ?>
        <div class="card">
            <div class="card-header">

                  <a href="article.php?idliste_de_souhait=<?= $wish['idliste_de_souhait']; ?>"><?= $wish['nom']; ?>
                  </a>

            </div>
            <div class="card-body">
                 
                 <p class="card-text">
                     <?= $wish['description']; ?>
                 </p>
                 <a href="article.php?idliste_de_souhait=<?= $wish['idliste_de_souhait']; ?>" class="btn btn-primary">Accéder au souhait</a>
                 <a href="edit-wish.php?idliste_de_souhait=<?= $wish['idliste_de_souhait']; ?>" class="btn btn-warning">Modifier le souhait</a>
                 <a href="actions/wishs/deleteWishAction.php?idliste_de_souhait=<?= $wish['idliste_de_souhait']; ?>" class="btn btn-danger">Supprimer le souhait</a>
              </div>
        </div>
        <br>
      <?php
    }
  ?>
  </div>

</body>
</html>