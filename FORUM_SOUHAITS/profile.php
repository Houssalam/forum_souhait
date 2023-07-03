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
                     </div>
                 </div>
                 <br>
                 <?php
             }
        }
        ?>
    </div>
</body>

</html>
