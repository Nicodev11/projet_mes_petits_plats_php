<?php

require_once 'profil.php';
require_once './lib/categories.php';
require_once './lib/recipes.php';
require_once './lib/config.php';
require_once './lib/tools.php';

$categories = getCategories($pdo);

if (!empty($_POST)) {
  if (isset($_POST['title'], $_POST['ingredients'], $_POST['instructions'], $_POST['category_id']) &&
  !empty($_POST["title"]) && !empty($_POST["ingredients"]) && !empty($_POST["instructions"]) && !empty($_POST["category_id"])) {

    $title = strip_tags($_POST['title']);
    $description = strip_tags($_POST['description']);
    $ingredients = strip_tags($_POST['ingredients']);
    $instructions = strip_tags($_POST['instructions']);
    $category_id = strip_tags($_POST['category_id']);
    

    if (isset($_FILES['file']['tmp_name']) && $_FILES['file']['tmp_name'] !== '') {
      $checkImage = getimagesize($_FILES['file']['tmp_name']);
      if ($checkImage !== false) {
          $fileName = uniqid().'-'.slugify($_FILES['file']['name']);
          if (move_uploaded_file($_FILES['file']['tmp_name'], _PATH_RECIPES_UPLOAD_.$fileName)) {
          } else {
              # Message flash l'image n'a pas été uploadé
          }
      } else {
          # Message flash ceci n'est pas une image
      }
    }

    $fileName = strip_tags($_POST['file']);

    updateRecipe($pdo, $_POST['title'], $_POST['description'], $_POST['ingredients'], $_POST['instructions'], (int)$_POST['category_id'], (int)$_SESSION['user']['id'], $fileName);

    header('location: indexRecipes.php');
  }
}

?>

<div class="container">
  <h1 class="fs-4 text-center m-3">Ajouter un plat</h1>
  <form class="container" method="POST" enctype="multipart/form-data">
    <div class="mb-3">
      <label for="title" class="form-label">Titre</label>
      <input type="text" name="title" id="title" class="form-control">
    </div>
    <div class="mb-3">
      <label for="description" class="form-label">Description</label>
      <textarea class="form-control" name="description" id="description" cols="30" rows="3"></textarea>
    </div>
    <div class="mb-3">
      <label for="ingredients" class="form-label">Ingredients</label>
      <textarea class="form-control" name="ingredients" id="ingredients" cols="30" rows="3"></textarea>
    </div>
    <div class="mb-3">
      <label for="instructions" class="form-label">Instructions</label>
      <textarea class="form-control" name="instructions" id="instructions" cols="30" rows="3"></textarea>
    </div>
    <div class="mb-3">
      <label for="category_id" class="form-label">Ingredients</label>
      <select name="category_id" id="category_id" class="form-select">
        <?php foreach ($categories as $category) { ?>
        <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
        <?php } ?>
      </select>
    </div>
    <div class="mb-3">
      <label for="file">Image</label>
      <input type="file" name="file" id="file">
    </div>
    <div class="mb-3">
      <input type="submit" name="saveRecipe" class="btn btn-primary" value="Enregistrer">
    </div>
  </form>
</div>

<?php require_once 'templates/footer.php'; ?>