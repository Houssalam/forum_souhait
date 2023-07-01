<?php
session_start();
require('actions/database.php');

// Vérifier si l'utilisateur est connecté en tant qu'administrateur
if (!isset($_SESSION['auth']) || $_SESSION['role'] != 2) {
    header("Location: login.php");
    exit;
}

// Récupérer les informations des utilisateurs depuis la base de données
$query = $bdd->query("SELECT iduser, nom, mail, isActive FROM user");
$users = $query->fetchAll();

// Filtrer les utilisateurs par nom d'utilisateur
if (isset($_GET['search'])) {
    $search = $_GET['search'];
    $filteredUsers = array_filter($users, function($user) use ($search) {
        return stripos($user['nom'], $search) !== false;
    });
    $users = $filteredUsers;
}
?>

<!DOCTYPE html>
<html>
<?php include 'includes/head.php'; ?>

<body>
    <?php include 'includes/navbar.php'; ?>
    <br><br>
    <div class="container bg-dark">
        <h1>Liste des utilisateurs</h1>

        <form class="mb-3" method="GET" action="users.php">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Rechercher par nom d'utilisateur" name="search">
                <button class="btn btn-primary" type="submit">Rechercher</button>
            </div>
        </form>

        <table class="table">
            <thead>
                <tr class="auto">
                    <th scope="col">Nom</th>
                    <th scope="col">Email</th>
                    <th scope="col">Actions</th>
                </tr>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td class="bg-dark text-white rounded p-2  align-middle" style="width: 300px;">
                            <?php echo $user['nom']; ?>
                        </td>
                        <td class="bg-primary text-white rounded p-2 align-middle" style="width: 300px;">
                            <?php echo $user['mail']; ?>
                        </td>
                        <td class="align-middle">
                            <a href="actions/users/deleteUserAction.php?iduser=<?php echo $user['iduser']; ?>" class="btn btn-danger">Supprimer</a>
                            <a href="actions/users/desableUserAction.php?iduser=<?php echo $user['iduser']; ?>" class="btn btn-warning">Désactiver</a>
                            <a href="actions/users/enableUserAction.php?iduser=<?php echo $user['iduser']; ?>" class="btn btn-success">Activer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </thead>
        </table>
    </div>
</body>
</html>
