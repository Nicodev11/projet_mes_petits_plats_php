<?php

require_once 'profil.php';

if (!empty($_POST)) {
  if (isset($_POST["lastname"], $_POST["firstname"],$_POST["city"]) &&
     !empty($_POST["lastname"]) && !empty($_POST["firstname"]) && !empty($_POST["city"])
  ) {

    $firstname = strip_tags($_POST['firstname']);
    $lastname = strip_tags($_POST['lastname']);
    $city = strip_tags($_POST['city']);

    updateUser($pdo, $_POST["firstname"], $_POST["lastname"], $_POST["city"], $_SESSION['user']['id']);

    $id = $_SESSION['user']['id'];
    $email = $_SESSION['user']['email'];

    $_SESSION['user'] = [
      'id' => $id,
      'firstname' => $firstname,
      'lastname' => $lastname,
      'email' => $email,
      'city' => $city,
      'role' => ['ROLE_USER'],
    ];

    header('location: showRecipes.php');

    setFlashMessage('Les modifications de vos informations personnelles ont bien été apportées', 'success');
  }
}

?>

<div class="container">
  <h1 class="fs-4 text-center m-3">Modifier mes informations personnelles</h1>
  <form class="container border rounded p-3" enctype="multipart/form-data" method="POST">
  <div class="row">
    <div class="col-md-6">
      <label for="lastname" class="form-label">Nom</label>
      <input type="text" class="form-control mb-2" name="lastname" id="lastname" value="<?= $_SESSION['user']['lastname'] ?>" required>
    </div>
    <div class="col-md-6">
      <label for="firstname" class="form-label">Prénom</label>
      <input type="text" class="form-control mb-2" name="firstname" id="firstname" value="<?= $_SESSION['user']['firstname'] ?>" required>
    </div>
  </div>
  <div>
    <div class="row">
      <div class="col-md-6">
        <label for="email" class="form-label">Adresse email</label>
        <p class="form-control mb-2"><?= $_SESSION['user']['email'] ?></p> 
      </div>
    </div>
    
  </div>
  <div class="col-md-6">
    <label for="city" class="form-label">Ville</label>
    <input type="text" class="form-control mb-2" name="city" value="<?= $_SESSION['user']['city'] ?>" id="city" required>
  </div>  
  <button class="btn btn-warning mt-2" type="submit">Modifier</button>
</form>
</div>

<?php

require_once './templates/footer.php';

?>