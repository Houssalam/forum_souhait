<?php 
session_start();
require('actions/wishs/showArticleContentAction.php');
require('actions/wishs/postCommentsAction.php');
require('actions/wishs/showAllCommentsOfWishAction.php');

?>


<!DOCTYPE html>
<html lang="en">
<?php include 'includes/head.php'; ?>
<body>

    <?php include 'includes/navbar.php'; ?>
    <br><br>

    <div class="container bg-image" style=background-image: url(images_bk/bg.jpg);">

    <?php

        if(isset($errorMsg)) { echo $errorMsg; }

           
        if(isset($wish_publication_date)){
            ?>
            <section class="show-content">
                  <h3><a href="prfoile.php?idliste_de_souhait=<?= $wish_lastname_author; ?>"></a></h3>

                  <hr>
                  <p><?= $wish_content; ?></p>
                  <hr>
                 <small><a href="profile.php?iduser=<?= $wish_id_author; ?>"><?= $wish_lastname_author; ?></a>&nbsp&nbsp<?= $wish_publication_date; ?></small>

            </section>
            <section class="show-answers">
                <br>
                <form class="form-group" method="POST">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Commentaire :</label>
                        <textarea name="comment" class="form-control"></textarea>
                        <br>
                        <button class="btn btn-primary" type="submit" name="validate">Envoyer votre commentaire</button>
                    </div>

            
                    
                </form>

                <?php 
                    while($comment = $getAllCommentsOfThisWish->fetch()){
                          ?>
                              <div class="card">
                                <div class="card-header">
                                  <a href="profile.php?iduser=<?= $comment['user_iduser']; ?>">
                                 <?= $comment["user_iduser"]; ?> </a>
                                </div>
                                <div class="card-body">
                                    <?= $comment['description']; ?>
                                </div>
                              </div>
                              <br>
                          <?php

                    };
                ?>
            </section>
            
            <?php
      }
    ?>
   
    </div>
    
</body>
</html>