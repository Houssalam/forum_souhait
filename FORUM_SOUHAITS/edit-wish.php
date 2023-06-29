<?php
require('actions/users/securityAction.php');
require('actions/wishs/getInfosOfEditedWishAction.php');
require('actions/wishs/editWishAction.php');
?>

<!DOCTYPE html>
<html lang="en">
<?php include 'includes/head.php'; ?>
<body>
<?php include 'includes/navbar.php'; ?>

    <br><br>
    <div class="container">

        <?php 
        if(isset($errorMsg)){
            echo '<p>'.$errorMsg.'</p>';
        }
        ?>

        <?php  
        if(isset($wish_description)){
        ?>
        <form method="POST">

            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Contenu du souhait</label>
                <textarea type="text" class="form-control" name="content"><?= $wish_description; ?></textarea>
            </div>

            <button type="submit" class="btn btn-primary" name="validate">Modifier le souhait</button>
        </form>

        <?php
        }
        ?>

    </div>
 
</body>
</html>
