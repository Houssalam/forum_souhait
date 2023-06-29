<?php


require('actions/database.php');

// Récupérer les souhaits par défaut sans recherche
$getAllWishs = $bdd->query('SELECT idliste_de_souhait, user_iduser, nom, description, date_publication FROM liste_de_souhait ORDER BY idliste_de_souhait DESC LIMIT 0,20');

// Vérifier si une recherche a été trouvée par l'utilisateur
if(isset($_GET['search']) && !empty($_GET['search'])) {

    // La recherche
    $usersSearch = $_GET['search'];

    // Récupérer tous les souhaits qui correspondent à la recherche (en fonction du titre)
    $getAllWishs = $bdd->prepare('SELECT idliste_de_souhait, user_iduser, nom, description, date_publication FROM liste_de_souhait WHERE description LIKE :usersSearch ORDER BY idliste_de_souhait DESC');
    $getAllWishs->execute(array(':usersSearch' => '%'.$usersSearch.'%'));
}

// ...
