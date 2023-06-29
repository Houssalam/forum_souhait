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
          if(isset($errorMsg)){echo $errorMsg;} 

          if(isset($getHisWishs)) {
             ?>
                <div class="card">
                    <div class="card-body">
                        <h4>@<?= $user_lastname; ?></h4>
                        <hr>
                        <p><?= $user_lastname . ' ' . $user_email; ?><br></p>
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