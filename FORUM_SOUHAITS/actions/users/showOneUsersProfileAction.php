<?php

require('actions/database.php');

// Récupérer l'identifiant de l'utilisateur
if(isset($_GET['iduser']) && !empty($_GET['iduser'])) {

    // L'id de l'utilisateur
    $idOfUser = $_GET['iduser'];

    // Vérifier si l'utilisateur existe
    $checkIfUserExists = $bdd->prepare('SELECT nom, mail, avatar FROM user WHERE iduser = ?');
    $checkIfUserExists->execute([$idOfUser]);

    if($checkIfUserExists->rowCount() > 0){

        // Récupérer toutes les données de l'utilisateur
        $usersInfos = $checkIfUserExists->fetch();

        $user_lastname = $usersInfos['nom'];
        $user_email = $usersInfos['mail'];
        $user_avatar = $usersInfos['avatar'];

        // Récupérer toutes les publications publiées par l'utilisateur
        $getHisWishs = $bdd->prepare('SELECT * FROM liste_de_souhait WHERE user_iduser = ? ORDER BY idliste_de_souhait DESC');
        $getHisWishs->execute([$idOfUser]);

        // // Passer les variables à editProfile.php
        // include('editProfile.php');

    }else{
        $errorMsg = "Aucun utilisateur trouvé";
    }

}else{
    $errorMsg = "Aucun utilisateur trouvé";
}
