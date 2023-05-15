<?php

require_once 'profil.php';
require_once './lib/recipes.php';

$recipes = getRecipeByUserId($pdo, $_SESSION['user']['id']);

?>
<h1 class="text-center m-3 fs-4">Vos recettes</h1>
<div class="container row mx-auto">
  <?php echo getFlashMessage() ?>
  <?php 
  if ($recipes) {
  foreach ($recipes as $index => $recipe) {
      require 'templates/card.php';
    }
  } else {?>
  <div class="container border rounded m-3 p-3 mx-auto col-md-6 d-flex flex-column justify-content-center">
    <h2 class="text-center fs-6">Vous n'avez pas encore crée de recettes</h2>
    <a href="addRecipes.php" class="btn btn-outline-success w-25 mt-3 m-auto">Créer une recette</a>
  </div>
   
  <?php } ?>
</div>

<?php 

require_once 'templates/footer.php'; ?>