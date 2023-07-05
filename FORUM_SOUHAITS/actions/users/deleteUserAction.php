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
        // Supprimer les commentaires liés à l'utilisateur
         $deleteComments = $bdd->prepare('DELETE FROM commentaire WHERE user_iduser = ?');
         $deleteComments->execute([$userId]);

          // Supprimer les enregistrements associés dans la table liste_de_souhait_has_article
        $deleteAssociatedRecords = $bdd->prepare('DELETE FROM liste_de_souhait_has_article WHERE liste_de_souhait_idliste_de_souhait IN (SELECT idliste_de_souhait FROM liste_de_souhait WHERE user_iduser = ?)');
        $deleteAssociatedRecords->execute([$userId]);

         // Supprimer les souhaits associés à l'utilisateur
        $deleteWishes = $bdd->prepare('DELETE FROM liste_de_souhait WHERE user_iduser = ?');
        $deleteWishes->execute([$userId]);


        // Supprimer l'utilisateur de la base de données
        $deleteUser = $bdd->prepare('DELETE FROM user WHERE iduser = ?');
        $deleteUser->execute([$userId]);

        // Rediriger vers la page des utilisateurs avec un message de confirmation
        header("Location: ../../users.php?success=Utilisateur supprimé avec succès");
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
