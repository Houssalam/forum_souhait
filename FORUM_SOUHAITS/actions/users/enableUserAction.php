<?php
session_start();
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
        // Activer l'utilisateur dans la base de données
        $enableUser = $bdd->prepare('UPDATE user SET isActive = 1 WHERE iduser = ?');
        $enableUser->execute([$userId]);

        // Rediriger vers la page des utilisateurs avec un message de confirmation
        header("Location: ../../users.php?success=Utilisateur activé avec succès");
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
?>

