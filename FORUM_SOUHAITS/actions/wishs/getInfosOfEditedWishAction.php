<?php
require('actions/database.php');

// Vérifier si l'id est bien passé en paramètre dans l'url
if(isset($_GET['idliste_de_souhait']) && !empty($_GET['idliste_de_souhait'])) {
    $idOfWish = $_GET['idliste_de_souhait'];

    // Vérifier si le souhait existe
    $checkIfWishExists = $bdd->prepare("SELECT * FROM liste_de_souhait WHERE idliste_de_souhait = ?");
    $checkIfWishExists->execute(array($idOfWish));

    if($checkIfWishExists->rowCount() > 0) {
        // Récupérer les données du souhait
        $wishInfos = $checkIfWishExists->fetch();
        if($wishInfos['user_iduser'] == $_SESSION['iduser']) {
            $wish_description = $wishInfos['description'];
            $wish_description = str_replace('<br />', '', $wish_description);
        } else {
            $errorMsg = "Vous n'êtes pas l'auteur de cette publication.";
        }
    } else {
        $errorMsg = "Aucun souhait n'a été trouvé.";
    }
} else {
    $errorMsg = "Aucun souhait n'a été trouvé.";
}
?>
