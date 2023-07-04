<?php
session_start();
require('actions/database.php');

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['iduser'])) {
    // Rediriger vers la page de connexion ou afficher un message d'erreur
    header('Location: login.php');
    exit;
}

// Récupérer les souhaits partagés pour l'utilisateur actuel
$userId = $_SESSION['iduser'];
$getSharedWishes = $bdd->prepare('SELECT s.idliste_de_souhait, s.nom, s.description, s.date_publication, u.nom AS utilisateur_partageur
                                FROM liste_de_souhait AS s
                                INNER JOIN partage_de_souhait AS p ON s.idliste_de_souhait = p.liste_de_souhait_idliste_de_souhait
                                INNER JOIN user AS u ON p.utilisateur_partageur_iduser = u.iduser
                                WHERE p.utilisateur_destinataire_iduser = ? AND p.utilisateur_destinataire_iduser = ?');
$getSharedWishes->execute([$userId, $userId]);
?>

<!DOCTYPE html>
<html lang="en">

<?php include('includes/head.php'); ?>

<body>
    <?php include('includes/navbar.php'); ?>
    <br><br>

    <div class="container">
        <h3>Souhaits partagés</h3>
        <hr>
        <?php if ($getSharedWishes->rowCount() > 0) { ?>
            <table class="table">
                <thead>
                    <tr>
                        <th>Titre</th>
                        <th>Description</th>
                        <th>Date de création</th>
                        <th>Partagé par</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($wish = $getSharedWishes->fetch()) { ?>
                        <tr>
                            <td><?= $wish['nom']; ?></td>
                            <td><?= $wish['description']; ?></td>
                            <td><?= $wish['date_publication']; ?></td>
                            <td><?= $wish['utilisateur_partageur']; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        <?php } else { ?>
            <p>Aucun souhait partagé trouvé.</p>
        <?php } ?>
        <br>
        <a href="profile.php?iduser=<?= $_SESSION['iduser']; ?>" class="btn btn-primary">Retour au profil</a>
    </div>
</body>

</html>
