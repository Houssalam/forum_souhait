<nav class="navbar navbar-expand-lg navbar-dark bg-warning">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">Blog</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" href="index.php">Les Souhaits</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="publish-wish.php">Publier un souhait</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="my-wishs.php">Mes souhaits</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="signup.php">Inscription</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="login.php">Connexion</a>
        </li>
        <?php 
          if(isset($_SESSION['auth'])){
            ?>
            <li class="nav-item">
              <a class="nav-link" href="profile.php?iduser=<?= $_SESSION['iduser']; ?>">Mon profil</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="actions/users/logoutAction.php">Déconnexion</a>
            </li>
            <?php
          }
        ?>
      </ul>
    </div>
  </div>
</nav>