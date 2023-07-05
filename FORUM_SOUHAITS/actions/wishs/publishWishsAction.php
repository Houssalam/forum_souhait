<?php

require('actions/database.php');

// Valider le formulaire
if(isset($_POST['validate'])){

    // Vérifier si les champs ne sont pas vides
    if(!empty($_POST['description']) && !empty($_POST['articleTitle']) && !empty($_POST['articleDescription'])){
        
        // Les données du souhait
        $wish_description = nl2br(htmlspecialchars($_POST['description']));
        $wish_date = date('d/m/y');
        $wish_id_author = $_SESSION['iduser'];
        $wish_lastname_author = $_SESSION['lastname'];

        // Insérer le souhait
        $insertWish = $bdd->prepare('INSERT INTO liste_de_souhait(nom, description, date_publication, user_iduser) VALUES(?, ?, ?, ?)');
        $insertWish->execute(
            array(
                $wish_lastname_author,
                $wish_description, 
                $wish_date,
                $wish_id_author
            )
        );

        // Récupérer l'ID du souhait inséré
        $wish_id = $bdd->lastInsertId();

        // Récupérer les champs d'article
        $articleTitles = $_POST['articleTitle'];
        $articleDescriptions = $_POST['articleDescription'];

        // Insérer les articles et établir les relations
        $numArticles = count($articleTitles);
        for ($i = 0; $i < $numArticles; $i++) {
            $articleTitle = $articleTitles[$i];
            $articleDescription = $articleDescriptions[$i];

            // Insérer l'article
            $insertArticle = $bdd->prepare('INSERT INTO article(nom, description) VALUES(?, ?)');
            $insertArticle->execute(
                array(
                    $articleTitle,
                    $articleDescription
                )
            );

            // Récupérer l'ID de l'article inséré
            $article_id = $bdd->lastInsertId();

            // Lier l'article au souhait dans la table de jonction
            $insertRelation = $bdd->prepare('INSERT INTO liste_de_souhait_has_article(liste_de_souhait_idliste_de_souhait, article_idarticle) VALUES(?, ?)');
            $insertRelation->execute(
                array(
                    $wish_id,
                    $article_id
                )
            );
        }
        
        $successMsg = "Votre souhait et les articles ont bien été publiés sur le site";
        
    } else {
        $errorMsg = "Veuillez compléter tous les champs requis...";
    }

}
