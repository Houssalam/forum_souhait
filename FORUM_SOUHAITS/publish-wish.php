<?php 
// Inclusion de l'action pour la sécurité de l'utilisateur
require('actions/users/securityAction.php'); 
 // Inclusion de l'action pour publier un souhait
require('actions/wishs/publishWishsAction.php');
?>
<!DOCTYPE html>
<html lang="en">
<?php include 'includes/head.php'; ?> <!-- Inclusion du fichier contenant les balises <head> -->
<body>
    <?php include 'includes/navbar.php'; ?> <!-- Inclusion du fichier contenant la barre de navigation -->

    <br><br>
    <form class="container" method="POST">

        <?php 
            if(isset($errorMsg)){ 
                echo '<p>'.$errorMsg.'</p>'; // Affichage du message d'erreur s'il existe
            } elseif(isset($successMsg)){ 
                echo '<p>'.$successMsg.'</p>'; // Affichage du message de succès s'il existe
            }
        ?>

        <div class="mb-3">
            <label for="wishDescription" class="form-label">Description du souhait</label>
            <textarea type="text" class="form-control" name="description"></textarea> 
        </div>

        <h2>Articles</h2>

        <div id="article-container">
            <div class="mb-3">
                <label for="articleTitle[]" class="form-label">Titre de l'article</label>
                <input type="text" class="form-control" name="articleTitle[]"> <!-- Champ de saisie du titre de l'article -->
            </div>
            <div class="mb-3">
                <label for="articleDescription[]" class="form-label">Description de l'article</label>
                <textarea class="form-control" name="articleDescription[]"></textarea> <!-- Champ de saisie de la description de l'article -->
            </div>
        </div>

        <button type="button" class="btn btn-primary" onclick="addArticle()">Ajouter un nouvel article</button> <!-- Bouton pour ajouter un nouvel article -->

        <button type="submit" class="btn btn-primary" name="validate">Publier le souhait avec les articles</button> <!-- Bouton pour publier le souhait avec les articles -->
   </form>

   <script>
       function addArticle() {
           var container = document.getElementById("article-container");
           var newArticle = `
           <div class="mb-3">
               <label for="articleTitle[]" class="form-label">Titre de l'article</label>
               <input type="text" class="form-control" name="articleTitle[]">
           </div>
           <div class="mb-3">
               <label for="articleDescription[]" class="form-label">Description de l'article</label>
               <textarea class="form-control" name="articleDescription[]"></textarea>
           </div>
           `;
           container.innerHTML += newArticle; // Ajout d'un nouvel article dans le formulaire lorsque le bouton est cliqué
       }
   </script>
</body>
</html>
