<?php 

// session_start();
require('actions/database.php');

$getAllMyWishs = $bdd->prepare('SELECT idliste_de_souhait, nom, description FROM liste_de_souhait WHERE user_iduser = ? ORDER BY idliste_de_souhait DESC');
$getAllMyWishs->execute(array($_SESSION['iduser']));