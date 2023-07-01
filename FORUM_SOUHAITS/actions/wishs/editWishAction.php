<?php
require('actions/database.php');

// Validation du formulaire
if(isset($_POST['validate'])) {

    // Vérifier si tous les champs sont remplis
    if(!empty($_POST['content'])) {
         
        // Vérifier si l'utilisateur est un administrateur ou l'auteur du souhait
        if ($_SESSION['role'] == 2 || $wishInfos['user_iduser'] == $_SESSION['iduser']) {

            // Les données à passer dans la requête
            $new_wish_description = nl2br(htmlspecialchars($_POST['content']));
            // Si vous prévoyez d'utiliser $new_wish_title et $new_wish_content, assurez-vous de les définir correctement.
            // $new_wish_title = htmlspecialchars($_POST['title']);
            // $new_wish_content = nl2br(htmlspecialchars($_POST['content']));

            // Modifier les informations du souhait qui possède l'id rentré en paramètre dans l'url
            $editWishOnWebsite = $bdd->prepare('UPDATE liste_de_souhait SET description = ? WHERE idliste_de_souhait = ?');
            $editWishOnWebsite->execute(array($new_wish_description, $idOfWish));

            // Redirection vers la page d'affichage des souhaits de l'utilisateur
            header('Location: my-wishs.php');

        } else {
            $errorMsg = "Vous n'êtes pas autorisé à modifier ce souhait.";
        }

    } else {
        $errorMsg = "Veuillez compléter tous les champs.";
    }
}
?>
