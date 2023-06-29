<?php
session_start();
if (!isset($_SESSION['auth'])) {
    header("Location: ../../login.php");
    exit;
}

require('../database.php');

if (isset($_GET['idliste_de_souhait']) && !empty($_GET['idliste_de_souhait'])) {
    $idOfTheWish = $_GET['idliste_de_souhait'];

    $checkIfTheWishExists = $bdd->prepare('SELECT user_iduser FROM liste_de_souhait WHERE idliste_de_souhait = ?');
    $checkIfTheWishExists->execute([$idOfTheWish]);

    if ($checkIfTheWishExists->rowCount() > 0) {
        $wishInfos = $checkIfTheWishExists->fetch();
        if ($wishInfos['user_iduser'] == $_SESSION['iduser']) {
            $deleteThisWish = $bdd->prepare('DELETE FROM liste_de_souhait WHERE idliste_de_souhait = ?');
            $deleteThisWish->execute([$idOfTheWish]);

            header("Location: ../../my-wishs.php");
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
?>
