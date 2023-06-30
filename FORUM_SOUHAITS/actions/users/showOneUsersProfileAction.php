<?php

require('actions/database.php');

// Récupérer l'identifiant de l'utilisateur
if(isset($_GET['iduser']) AND ! empty($_GET['iduser'])) {

// l'id de l'utilisateur
    $idOfUser = $_GET['iduser'];

// Vérifier si l'utilisateur existe
    $checkIfUserExists = $bdd->prepare('SELECT  nom, mail, avatar FROM user WHERE iduser =?');
    $checkIfUserExists->execute(array($idOfUser));

    if($checkIfUserExists->rowCount() > 0){

// Récupérer toutes les données de l'utilisateur
        $usersInfos = $checkIfUserExists->fetch();

        
        $user_lastname = $usersInfos['nom'];
        $user_email = $usersInfos['mail'];
        $user_avatar = $usersInfos['avatar'];
        

// Récupérer toutes les  pubiliées par l'utilisateur
        $getHisWishs = $bdd->prepare('SELECT * FROM liste_de_souhait WHERE user_iduser =? ORDER BY idliste_de_souhait DESC');
        $getHisWishs->execute(array($idOfUser));

    }else{
        $errorMsg = "Aucun utilisateur trouvée";
    }

}else{
    $errorMsg = "Aucun utilisateur trouvé";
}