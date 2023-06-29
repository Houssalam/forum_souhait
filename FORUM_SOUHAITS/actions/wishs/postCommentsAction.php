<?php


require('actions/database.php');

if(isset($_POST['validate'])) {
    if(!empty($_POST['comment'])) {
        $user_comment = nl2br(htmlspecialchars($_POST['comment']));
        $user_id = intval($_SESSION['iduser']); // Conversion en entier

        $insertComment = $bdd->prepare('INSERT INTO commentaire(description, user_iduser, liste_de_souhait_idliste_de_souhait) VALUES(?, ?, ?)');
        $insertComment->execute(array($user_comment, $user_id, $idOfTheWish));
    }
}
