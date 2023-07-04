<?php


require('actions/database.php');

if(isset($_POST['validate'])) {
    if(!empty($_POST['comment'])) {
        $user_comment = nl2br(htmlspecialchars($_POST['comment']));
        $user_id = intval($_SESSION['iduser']); // Conversion en entier
        $currentDate = date('Y-m-d H:i:s'); // Format de date : AAAA-MM-JJ HH:MM:SS

        $insertComment = $bdd->prepare('INSERT INTO commentaire(description, user_iduser, date, liste_de_souhait_idliste_de_souhait) VALUES(?, ?, ?, ?)');
        $insertComment->execute(array($user_comment, $user_id, $currentDate, $idOfTheWish));
    }
}




