<?php
session_start();
require('actions/users/showOneUsersProfileAction.php');

?>

<!DOCTYPE html>
<html lang="en">

<?php include('includes/head.php');?>

<body>
    <?php include('includes/navbar.php');?>
    <br><br>

    <div class="container">
        <?php 
        if(isset($errorMsg)){
            echo $errorMsg;
        } 

        if(isset($getHisWishs)) {
            ?>
            <div class="card">
                <div class="card-body">
                    <h4>@<?= $user_lastname; ?></h4>
                    <hr>
                    <p><?= $user_lastname . '<br>' . $user_email; ?></p>
                    <?php if(!empty($user_avatar)): ?>
                        <img src="<?= $user_avatar; ?>" alt="Avatar" style="width: 150px; height: 150px; border-radius: 50%;">
                    <?php endif; ?>
                    <br><br>

                   <a href="editProfile.php?iduser=<?= $_SESSION['iduser']; ?>" class="btn btn-primary">Modifier</a>


                </div>
            </div>
            <br>
            <?php
             
             while($wish = $getHisWishs->fetch()){
                 ?>
                 <div class="card">
                     <div class="card-header">
                        <?= $wish['nom']; ?>
                     </div>
                     <div class="card-body">
                         <?= $wish['description']; ?>
                     </div>
                     <div class="card-footer">
                         Par <?= $wish['nom']; ?> le <?= $wish['date_publication']; ?>
                         <br>
                         <a href="shareWish.php?idliste_de_souhait=<?= $wish['idliste_de_souhait']; ?>&iduser=<?= $_SESSION['iduser']; ?>" class="btn btn-primary">Partager</a>

                     </div>
                 </div>
                 <br>
                 <?php
             }
        }

        // Récupérer les souhaits partagés par l'utilisateur
        $getSharedWishs = $bdd->prepare('SELECT liste_de_souhait.idliste_de_souhait, liste_de_souhait.nom, liste_de_souhait.description, liste_de_souhait.date_publication, user.nom AS user_nom FROM liste_de_souhait
            INNER JOIN partage_de_souhait ON liste_de_souhait.idliste_de_souhait = partage_de_souhait.liste_de_souhait_idliste_de_souhait
            INNER JOIN user ON partage_de_souhait.utilisateur_destinataire_iduser = user.iduser
            WHERE partage_de_souhait.utilisateur_partageur_iduser = ? ORDER BY liste_de_souhait.idliste_de_souhait DESC');
        $getSharedWishs->execute([$idOfUser]);
        ?>
        
        <!-- Affichage des souhaits partagés -->
        <div class="shared-wishes">
            <h3>Souhaits partagés</h3>
            <div class="row">
                <?php while($sharedWish = $getSharedWishs->fetch()) { ?>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <?= $sharedWish['nom']; ?>
                            </div>
                            <div class="card-body">
                                <?= $sharedWish['description']; ?>
                            </div>
                            <div class="card-footer">
                                Partagé par <?= $sharedWish['user_nom']; ?> le <?= $sharedWish['date_publication']; ?>
                            </div>
                        </div>
                        <br>
                    </div>
                <?php } ?>
            </div>
        </div>
        
    </div>
</body>

</html>
