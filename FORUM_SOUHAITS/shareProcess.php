<?php
session_start();
require('actions/database.php');

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['iduser'])) {
    // Rediriger vers la page de connexion ou afficher un message d'erreur
    header('Location: login.php');
    exit;
}

// Récupérer les utilisateurs sélectionnés pour le partage
if (isset($_POST['users']) && isset($_POST['idliste_de_souhait'])) {
    $users = $_POST['users'];
    $idliste_de_souhait = $_POST['idliste_de_souhait'];

    // Insérer le partage dans la table partage_de_souhait pour chaque utilisateur sélectionné
    foreach ($users as $userId) {
        $insertShare = $bdd->prepare('INSERT INTO partage_de_souhait (utilisateur_partageur_iduser, utilisateur_destinataire_iduser, liste_de_souhait_idliste_de_souhait) VALUES (?, ?, ?)');
        $insertShare->execute([$_SESSION['iduser'], $userId, $idliste_de_souhait]);
    }

    // Définir la variable de session pour indiquer le succès du partage
    $_SESSION['share_success'] = true;

    // Rediriger vers la page de succès
    header('Location: shareSuccess.php');
    exit;
} else {
    // Rediriger vers la page d'erreur ou afficher un message d'erreur
    header('Location: shareError.php');
    exit;
}

