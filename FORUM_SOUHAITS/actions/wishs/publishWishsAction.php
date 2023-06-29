<?php

require('actions/database.php');

// Valider le formulaire
if(isset($_POST['validate'])){

    // Vérifier si les champs ne sont pas vides
    if(!empty($_POST['description'])){
        
        // Les données du souhait
        
        $wish_description = nl2br(htmlspecialchars($_POST['description']));
        $wish_date = date('d/m/y');
        $wish_id_author = $_SESSION['iduser'];
        $wish_lastname_author = $_SESSION['lastname'];
       
        

        // Insérer le souhait sur le souhait
        $insertWishsOnWebsite = $bdd->prepare('INSERT INTO liste_de_souhait(nom, description, date_publication, user_iduser) VALUES(?, ?, ?, ?)');
        $insertWishsOnWebsite->execute(
            array(
              
                $wish_lastname_author,
                $wish_description, 
                $wish_date,
                $wish_id_author
                
            )
        );
        
        $successMsg = "Votre souhait a bien été publiée sur le site";
        
    } else {
        $errorMsg = "Veuillez compléter le champs Description du souhait ...";
    }

}

