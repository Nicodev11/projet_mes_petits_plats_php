<?php

require_once 'profil.php';
require_once './lib/categories.php';
require_once './lib/recipes.php';
require_once './lib/config.php';
require_once './lib/tools.php';

$categories = getCategories($pdo);

$id = $_GET['id'];

$recipes = getRecipeById($pdo, $id);

if (!empty($_POST)) {
  if (
    isset($_POST['title'], $_POST['ingredients'], $_POST['instructions'], $_POST['category_id']) &&
    !empty($_POST["title"]) && !empty($_POST["ingredients"]) && !empty($_POST["instructions"]) &&
    !empty($_POST["category_id"])) {
  
      $title = strip_tags($_POST['title']);
      $description = strip_tags($_POST['description']);
      $ingredients = strip_tags($_POST['ingredients']);
      $instructions = strip_tags($_POST['instructions']);
      $category_id = strip_tags($_POST['category_id']);
      $fileName = $_FILES['file']['name'];
      $id = $_GET['id'];

    if (isset($_FILES['file']['tmp_name']) && $_FILES['file']['tmp_name'] !== '') {
      $checkImage = getimagesize($_FILES['file']['tmp_name']);
      if ($checkImage !== false) {
        $fileName = uniqid() . '-' . slugify($_FILES['file']['name']);
        if (move_uploaded_file($_FILES['file']['tmp_name'], _PATH_RECIPES_UPLOAD_ . $fileName)) {
        } else {
          setFlashMessage('Le fichier n\'a pas été uploadé', 'danger');
        }
      } else {
        setFlashMessage('Le fichier doit être une image', 'danger');
      }
    }

    updateRecipe(
      $pdo,
      $_POST['title'],
      $_POST['description'],
      $_POST['ingredients'],
      $_POST['instructions'],
      $_POST['category_id'],
      $fileName,
      $id
    );

    setFlashMessage('Votre recette à bien été modifié', 'success');

    header("location: showRecipes.php");
  } else {
    setFlashMessage('Veuillez remplir tous les champs obligatoire', 'danger');
  }
}

foreach ($recipes as $key => $recipe) {

if ($_SESSION['user']['id'] === $recipe['user_id']) { ?>
<div class="container">
  <h1 class="fs-4 text-center m-3">Modifier la recette</h1>
  <form class="container m-auto" method="POST" enctype="multipart/form-data">
    <div class="col-md-6 mx-auto">
      <label for="title" class="form-label">Titre</label>
      <input type="text" name="title" value="<?= $recipe['title'] ?>" id="title" class="form-control">
    </div>
    <div class="col-md-6 mx-auto">
      <label for="category_id" class="form-label">Catégorie</label>
      <select name="category_id" id="category_id" class="form-select">
        <?php foreach ($categories as $category) { ?>
        <option value="<?= $category['id'] ?>"><?= $category['name'] ?></option>
        <?php } ?>
      </select>
    </div>
    <div class="col-md-6 mx-auto">
      <label for="description" class="form-label">Description</label>
      <textarea class="form-control" name="description" id="description" cols="30" rows="3"><?= $recipe['description'] ?></textarea>
    </div>

    <div class="col-md-6 mx-auto">
      <label for="ingredients" class="form-label">Ingredients</label>
      <textarea class="form-control" name="ingredients" id="ingredients" cols="30" rows="3"><?= $recipe['ingredients'] ?></textarea>
    </div>
    <div class="col-md-6 mx-auto">
      <label for="instructions" class="form-label">Instructions</label>
      <textarea class="form-control" name="instructions" id="instructions" cols="30" rows="3"><?= $recipe['instructions'] ?></textarea>
    </div>

    <div class="col-md-6 mx-auto mb-3">
      <label for="formFile" class="form-label">Image</label>
      <input class="form-control" name="file" value="<?= $recipe['image'] ?>" type="file" id="formFile">
    </div>
    <div class="mb-3 col-md-6 mx-auto">
      <input type="submit" name="saveRecipe" class="btn btn-primary" value="Enregistrer">
    </div>
  </form>
</div>
</div>
<?php
} else {
  echo "vous n'avez pas accés a la page";
}?>


<?php }

require_once 'templates/footer.php'; ?>