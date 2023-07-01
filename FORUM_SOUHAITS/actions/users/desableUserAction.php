<?php

session_start();
if (!isset($_SESSION['auth'])) {
    header("Location: ../../login.php");
    exit;
}
require('../database.php');

// Vérifier si l'utilisateur est connecté en tant qu'administrateur
if (!isset($_SESSION['auth']) || $_SESSION['role'] != 2) {
    header("Location: ../../login.php");
    exit;
}

if (isset($_GET['iduser']) && !empty($_GET['iduser'])) {
    $userId = $_GET['iduser'];

    // Vérifier si l'utilisateur existe dans la base de données
    $checkUser = $bdd->prepare('SELECT iduser FROM user WHERE iduser = ?');
    $checkUser->execute([$userId]);
    $userExists = $checkUser->rowCount() > 0;

    if ($userExists) {
        // Désactiver l'utilisateur dans la base de données
        $disableUser = $bdd->prepare('UPDATE user SET isActive = 0 WHERE iduser = ?');
        $disableUser->execute([$userId]);

        // Rediriger vers la page des utilisateurs avec un message de confirmation
        header("Location: ../../users.php?success=Utilisateur désactivé avec succès");
        exit;
    } else {
        // L'utilisateur n'existe pas, rediriger avec un message d'erreur
        header("Location: ../../users.php?error=L'utilisateur n'existe pas");
        exit;
    }
} else {
    // Rediriger vers la page des utilisateurs avec un message d'erreur
    header("Location: ../../users.php?error=ID d'utilisateur manquant");
    exit;
}
