<?php

require('actions/database.php');

// Véfifider si l'id du souhait est rentré dans l'URL
if(isset($_GET['idliste_de_souhait']) AND ! empty($_GET['idliste_de_souhait'])) {

// Vérifier si le souhait existe
    $idOfTheWish = $_GET['idliste_de_souhait'];
    $checkIfWishExists = $bdd->prepare("SELECT * FROM liste_de_souhait WHERE idliste_de_souhait =?");
    $checkIfWishExists->execute(array($idOfTheWish));

    if($checkIfWishExists->rowCount() > 0){

// Récuperer toutes les data du souhait
         $wishsInfos = $checkIfWishExists->fetch();

// Stocker les data du souhait dans des variables propres
         $wish_id_author = $wishsInfos['user_iduser'];
         $wish_lastname_author = $wishsInfos['nom'];
         $wish_content = $wishsInfos['description'];
         $wish_publication_date = $wishsInfos['date_publication'];
         

    }else {
        $errorMsg = "Aucun souhait n'a été trouvée.";
    }
    

}else {
    $errorMsg = "Aucun souhait n'a été trouvée";
}