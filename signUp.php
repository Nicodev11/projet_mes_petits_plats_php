<?php

require_once 'lib/pdo.php';
require_once 'lib//user.php';
session_start();

if (isset($_SESSION['user'])) {
  header("location: profil.php");
}

if (!empty($_POST)) {
  if (isset($_POST["lastname"], $_POST["firstname"], $_POST["email"], $_POST["password"],$_POST["city"]) &&
     !empty($_POST["lastname"]) && !empty($_POST["firstname"]) && !empty($_POST["email"]) &&  !empty($_POST["password"]) && !empty($_POST["city"])
  ) {

    $firstname = strip_tags($_POST['firstname']);
    $lastname = strip_tags($_POST['lastname']);
    $city = strip_tags($_POST['city']);
    $email = strip_tags($_POST['email']);

    if (!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^\w\s])[a-zA-Z\d\W]{8,}$/", $_POST['password'])) {
      # code message flash Mot de passe doit contenir au moins 8 caractères dont une majuscule, une minuscule et un chiffre minimum
    }

    $passwordHash = password_hash($_POST['password'], PASSWORD_DEFAULT);
    
    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
      # code message flash l'adresse email n'est pas valide
    }

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email= :email");
    $stmt->bindParam(':email', $_POST['email'], PDO::PARAM_STR);
    $stmt->execute();
    $user = $stmt->fetch();
    if (!$user) {
        # code message flash pour indiquer qu'un problème est survenu
    }
    
    saveUser($pdo, $_POST["firstname"], $_POST["lastname"], $_POST["email"], $passwordHash, $_POST["city"]);

    $id = $pdo->lastInsertId();

    $_SESSION['user'] = [
      'id' => $id,
      'firstname' => $firstname,
      'lastname' => $lastname,
      'email' => $email,
      'city' => $city,
      'role' => ['ROLE_USER'],
    ];
    
    header("location: showRecipes.php");

  } else {
    
  }
}


include_once './templates/header.php';
?>

<h1 class="text-center m-3">Inscription</h1>

<form class="container" enctype="multipart/form-data" method="POST">
  <div class="row">
    <div class="col-md-6">
      <label for="lastname" class="form-label">Nom</label>
      <input type="text" class="form-control mb-2" name="lastname" id="lastname" required>
    </div>
    <div class="col-md-6">
      <label for="firstname" class="form-label">Prénom</label>
      <input type="text" class="form-control mb-2" name="firstname" id="firstname" required>
    </div>
  </div>
  <div>
    <label for="email" class="form-label">Adresse email</label>
    <input type="text" class="form-control mb-2" name="email" id="email" aria-describedby="inputGroupPrepend" required>
  </div>
  <div>
    <label for="password" class="form-label">Mot de passe</label>
    <input type="password" class="form-control mb-2" autocomplete="on" name="password" id="password" required>
  </div>
  <div class="col-md-6">
    <label for="city" class="form-label">Ville</label>
    <input type="text" class="form-control mb-2" name="city" id="city" required>
  </div>
  <button class="btn btn-warning" type="submit">s'inscrire</button>
</form>

<?php
include_once './templates/footer.php'
?>

