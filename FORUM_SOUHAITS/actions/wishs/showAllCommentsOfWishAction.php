<?php

require('actions/database.php');

$getAllCommentsOfThisWish = $bdd->prepare('SELECT description, date, user_iduser, liste_de_souhait_idliste_de_souhait FROM commentaire WHERE liste_de_souhait_idliste_de_souhait = ? ORDER BY idcommentaire DESC');
$getAllCommentsOfThisWish->execute(array($idOfTheWish));
