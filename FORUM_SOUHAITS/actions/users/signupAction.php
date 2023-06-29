<?php
session_start();
require('actions/database.php');

// Validation du formulaire
if(isset($_POST['validate'])){

    // Vérifier si l'utilisateur a bien complété tous les champs
    if(!empty($_POST['lastname']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['avatar_link'])){

        // Données de l'utilisateur
        $user_lastname = htmlspecialchars($_POST['lastname']);
        $user_email = htmlspecialchars($_POST['email']);
        $user_password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $user_avatar = htmlspecialchars($_POST['avatar_link']);

        // Vérifier si l'utilisateur existe déjà sur le site
        $checkIfUserAlreadyExists = $bdd->prepare('SELECT mail FROM user WHERE mail = ?');
        $checkIfUserAlreadyExists->execute(array($user_email));

        if($checkIfUserAlreadyExists->rowCount() == 0){

            // Insérer l'utilisateur dans la base de données
            $insertUserOnWebsite = $bdd->prepare('INSERT INTO user(nom, mail, mdp, isActive, role, avatar) VALUES(?, ?, ?, ?, ?, ?)');
            $isActive = 1; // Valeur de isActive (1 pour actif, 0 pour inactif)

            // Attribuer la valeur du rôle en fonction des cas
            if ($user_role === "admin") {
                $role = 2; // Rôle d'administrateur
            } elseif ($user_role === "visiteur") {
                $role = 3; // Rôle de visiteur
            } else {
                $role = 1; // Rôle par défaut : utilisateur
            }

            $insertUserOnWebsite->execute(array($user_lastname, $user_email, $user_password, $isActive, $role, $user_avatar));

            // Récupérer les informations de l'utilisateur
            $getInfosOfThisUserReq = $bdd->prepare('SELECT iduser, nom, mail, avatar FROM user WHERE mail = ?');
            $getInfosOfThisUserReq->execute(array($user_email));

            $usersInfos = $getInfosOfThisUserReq->fetch();

            // Authentifier l'utilisateur sur le site et récupérer ses données dans des variables de session globales
            $_SESSION['auth'] = true;
            $_SESSION['iduser'] = $usersInfos['iduser'];
            $_SESSION['lastname'] = $usersInfos['nom'];
            $_SESSION['email'] = $usersInfos['mail'];
            $_SESSION['avatar_link'] = $usersInfos['avatar'];

            // Rediriger l'utilisateur vers la page d'accueil
            header('Location: login.php');

        } else {
            $errorMsg = "L'utilisateur existe déjà sur le site";
        }

    } else {
        $errorMsg = "Veuillez compléter tous les champs...";
    }
}


?>
