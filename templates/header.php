<?php

require_once 'lib/pdo.php';
require_once 'lib//user.php';

if (!empty($_POST)) {
  if (isset($_POST["email"], $_POST["password"]) && !empty($_POST["email"]) &&  !empty($_POST["password"])
  ) {

    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
      # code message flash l'adresse email n'est pas valide
    }

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email= :email");
    $stmt->bindParam(':email', $_POST['email'], PDO::PARAM_STR);
    $stmt->execute();
    $user = $stmt->fetch();

    if (!$user) {
      # code message flash utilisateur ou mot de passe incorrect
    }

    if (!password_verify($_POST['password'], $user['password'])) {
      # code message flash utilisateur ou mot de passe incorrect
    }
    
  

    $_SESSION['user'] = [
      'id' => $user['id'],
      'firstname' => $user['firstname'],
      'lastname' => $user['lastname'],
      'email' => $user['email'],
      'city' => $user['city'],
      'role' => $user['role'],
    ];
    
    # header("location: profil.php");
    
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="Trouvez et partagez vos idées recettes rapidement et gratuitement">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="stylesheet" href="./style/style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  <title>Mes petits plats</title>
</head>

<body>
  <header>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
      <div class="container-fluid">
        <a class="navbar-brand" href="#">
          <img src="./assets/img/logo.png" class="w-50" alt="Logo">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0 fs-4 mx-auto">
            <li class="nav-item me-3">
              <a class="nav-link active" aria-current="page" href="#">Accueil</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Catégories
              </a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item fs-5" href="#">Entrées</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item fs-5" href="#">Plats</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item fs-5" href="#">Desserts</a></li>
              </ul>
            </li>
            <li class="nav-item me-3">
              <a class="nav-link" href="#">Recettes</a>
            </li>
            <li class="nav-item me-3">
              <a class="nav-link" href="#">A propos</a>
            </li>
          </ul>
          <?php 
            if (isset($_SESSION['user']['id'])) { ?>
              <a href="/logOut.php" class="btn btn-danger">Déconnexion</a>
          <?php } else { ?>  
            <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModal">
              Se connecter
            </button>
          <?php } ?>
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Se connecter</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <form class="container" enctype="multipart/form-data" method="POST">
                      <div>
                        <label for="email" class="form-label">Adresse email</label>
                        <input type="text" class="form-control mb-2" name="email" id="email" aria-describedby="inputGroupPrepend" required>
                      </div>
                      <div>
                        <label for="password" class="form-label">Mot de passe</label>
                        <input type="password" class="form-control mb-2" autocomplete="on" name="password" id="password" required>
                      </div>
                      <button class="btn btn-warning" type="submit">s'inscrire</button>
                    </form>
                  </div>
                  <div class="modal-footer">
                    <p>Vous n'avez pas de compte ?</p>
                    <button type="button" class="btn btn-primary">S'inscrire</button>
                  </div>
                </div>
              </div>
            </div>   
        </div>
      </div>
    </nav>
  </header>

  <main>