<?php
session_start();
require('../database.php');

// ...
if (isset($_POST['updateProfile'])) {
    // ...
    $avatar = $_POST['avatar'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $user_id = $_SESSION['iduser'];

    // Mettre à jour les informations dans la base de données
    $sql = "UPDATE user SET nom = :name, mail = :email, avatar = :avatar WHERE iduser = :user_id";
    $stmt = $bdd->prepare($sql);
    $stmt->execute([
        'name' => $name,
        'email' => $email,
        'avatar' => $avatar,
        'user_id' => $user_id,
    ]);

    $_SESSION['success'] = "Vos informations ont été mises à jour avec succès.";
    header("Location: ../../profile.php?iduser=".$_SESSION['iduser']);
    // exit();
} else {
    header("Location: ../editProfile.php");
    exit();
}

?>

