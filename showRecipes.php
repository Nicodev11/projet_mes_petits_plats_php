<?php

require_once 'profil.php';
require_once './lib/recipes.php';

$recipes = getRecipes($pdo);


foreach ($recipes as $index => $recipe) {?>
<div class="card" style="width: 18rem;">
  <img src="..." class="card-img-top" alt="...">
  <div class="card-body">
    <h5 class="card-title"> <?= $recipe['title'] ?> </h5>
    <p class="card-text"><?= $recipe['description'] ?> </p>
    <a href="#" class="btn btn-primary"><?=$recipe['id'];?></a>
  </div>
</div>
<?php }

require_once 'templates/footer.php'; ?>