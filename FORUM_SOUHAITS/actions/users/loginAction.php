<?php
session_start();
require('actions/database.php');

// Validation du formulaire
if (isset($_POST['validate'])) {

    // Vérifier si l'utilisateur a bien complété tous les champs
    if (!empty($_POST['email']) && !empty($_POST['password'])) {

        // Données de l'utilisateur
        $user_email = htmlspecialchars($_POST['email']);
        $user_password = htmlspecialchars($_POST['password']);

        // Vérifier si l'utilisateur existe (si l'email est correct)
        $checkIfUserExists = $bdd->prepare('SELECT * FROM user WHERE mail = ?');
        $checkIfUserExists->execute(array($user_email));

        if ($checkIfUserExists->rowCount() > 0) {

            // Récupérer les données de l'utilisateur
            $usersInfos = $checkIfUserExists->fetch();
            $user_role = $usersInfos['role'];

            // Vérifier si le compte de l'utilisateur est actif
            if ($usersInfos['isActive'] == 1) {

                // Vérifier si le mot de passe est correct
                if (password_verify($user_password, $usersInfos['mdp'])) {

                    // Authentifier l'utilisateur sur le site et récupérer ses données dans des variables globales sessions
                    $_SESSION['auth'] = true;
                    $_SESSION['iduser'] = $usersInfos['iduser'];
                    $_SESSION['lastname'] = $usersInfos['nom'];
                    $_SESSION['email'] = $usersInfos['mail'];
                    $_SESSION['avatar_link'] = $usersInfos['avatar'];
                    $_SESSION['role'] = $usersInfos['role'];

                    // Rediriger l'utilisateur vers la page d'accueil
                    header('Location: index.php');

                } else {
                    $errorMsg = "Votre mot de passe est incorrect...";
                }
            } else {
                $errorMsg = "Votre compte a été désactivé. Veuillez contacter l'administrateur.";
            }
        } else {
            $errorMsg = "Votre email est incorrect...";
        }
    } else {
        $errorMsg = "Veuillez compléter tous les champs...";
    }
}
?>
