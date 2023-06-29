<?php 
    session_start();
    require('actions/wishs/showAllWishsAction.php');
?>
<!DOCTYPE html>
<html lang="en">
<?php include 'includes/head.php'; ?>
<body>
    <?php include 'includes/navbar.php'; ?>
    <br><br>

   <div class="container">

    <form method="GET">

       
        <div class="form-group row">

            <div class="col-8">
                <input type="search" name="search" class="form-control">
            </div>
            <div class="col-4">
                <button class="btn btn-success" type="submit">Rechercher</button>
            </div>
        </div>
    </form>
    
    <br>

    <?php 
        while($wish = $getAllWishs->fetch()){
            ?>
                <div class="card">
                    <div class="card-header">
                        <a href="article.php?idliste_de_souhait=<?= $wish['idliste_de_souhait']; ?>"><?= $wish['nom']; ?>
                        </a>
                    </div>
                    <div class="card-body">
                         <?= $wish['description']; ?>
                    </div>
                    <div class="card-footer">
                        Publié par <a href="profile.php?iduser=<?= $wish['user_iduser']; ?>"><?= $wish['nom']; ?></a> le <?= $wish['date_publication']; ?>

                    </div>
                </div>
                <br>
            <?php
        }
    
    ?>
   </div>

</body>
</html>

    