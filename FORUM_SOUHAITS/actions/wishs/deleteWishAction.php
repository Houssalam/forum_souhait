<?php
session_start();
if (!isset($_SESSION['auth'])) {
    header("Location: ../../login.php");
    exit;
}

require('../database.php');

if (isset($_GET['idliste_de_souhait']) && !empty($_GET['idliste_de_souhait'])) {
    $idOfTheWish = $_GET['idliste_de_souhait'];

    // Supprimer les enregistrements associés dans la table liste_de_souhait_has_article
    $deleteAssociatedArticles = $bdd->prepare('DELETE FROM liste_de_souhait_has_article WHERE liste_de_souhait_idliste_de_souhait = ?');
    $deleteAssociatedArticles->execute([$idOfTheWish]);

    // Vérifier si le souhait existe et si l'utilisateur est autorisé à le supprimer
    $checkIfTheWishExists = $bdd->prepare('SELECT user_iduser FROM liste_de_souhait WHERE idliste_de_souhait = ?');
    $checkIfTheWishExists->execute([$idOfTheWish]);

    if ($checkIfTheWishExists->rowCount() > 0) {
        $wishInfos = $checkIfTheWishExists->fetch();

        // Vérifier si l'utilisateur est l'auteur du souhait ou un administrateur
        if ($wishInfos['user_iduser'] == $_SESSION['iduser'] || $_SESSION['role'] == 2) {
            // Supprimer le souhait
            $deleteThisWish = $bdd->prepare('DELETE FROM liste_de_souhait WHERE idliste_de_souhait = ?');
            $deleteThisWish->execute([$idOfTheWish]);

            // Redirection vers la page my-wishs.php avec le message de succès en paramètre
            header("Location: ../../my-wishs.php?success=Le souhait a été supprimé avec succès");
            exit;
        } else {
            $error = "Vous n'avez pas le droit de supprimer un souhait qui ne vous appartient pas !";
        }
    } else {
        $error = "Aucun souhait n'a été trouvé";
    }
} else {
    $error = "Aucun souhait n'a été trouvé";
}

// En cas d'erreur, rediriger l'utilisateur vers une page d'erreur avec un message approprié
header("Location: ../../error.php?message=" . urlencode($error));
exit;
?>
