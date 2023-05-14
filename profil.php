<?php
session_start();

require_once './templates/header.php';

?>

<div class="container">
  <h1 class="text-center mt-5 mb-2 fs-3 fw-bold">Mon compte</h1>
  <p class="text-center fst-italic">Voir et mettre à jour vos informations personnelles et gérez vos recettes ici.</p>
  <div class="row container">
    <div class="col-md-4 text-center mb-3">
      <a class="btn btn-outline-warning rounded-pill w-100" href="infos.php">Informations personnelles</a>
    </div>
    <div class="col-md-4 text-center mb-3">
      <a class="btn btn-outline-success rounded-pill w-100" href="addRecipes.php">Ajouter une recette</a>
    </div>
    <div class="col-md-4 text-center mb-3">
      <a class="btn btn-outline-primary rounded-pill w-100" href="showRecipes.php">Gérer mes recettes</a>
    </div>
  </div>
</div>