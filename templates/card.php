<?php 

require_once './lib/recipes.php';

if (isset($_POST['delete_recipe'])) {
  deleteRecipes($pdo, $_POST['id']);
  setFlashMessage('Recette supprimée', 'danger');
  header("location: showRecipes.php");
  exit();
}

?>


<div class="col-md-4 my-2">
  <div class="card" style="width: 18rem;">
    <div class="card-body">
      <h5 class="card-title text-center"> <?= $recipe['title'] ?> </h5>
      <p class="card-text text-center"><?= $recipe['description'] ?> </p>
      <p class="card-text"><?php
        if ($recipe['category_id'] === 1) {
          ?> <p class="fst-italic fw-bold float-end">Entrée</p> <?php
        } 
        if ($recipe['category_id'] === 2) {
          ?> <p class="fst-italic fw-bold float-end">Plats</p> <?php
        } 
        if ($recipe['category_id'] === 3) {
          ?> <p class="fst-italic fw-bold float-end">Desserts</p> <?php
        } 
      ?> </p>
      <div class="buttons d-flex justify-content-center">
        <a href="editRecipes.php?id=<?=$recipe['id'];?>" class="btn btn-warning me-3"><i class="bi bi-gear-fill"></i></a>
        <form method="POST">
          <input type="hidden" name="id" value="<?php echo $recipe['id']; ?>">
          <button class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet article ?')" type="submit"           name="delete_recipe">Supprimer</button>
        </form>
      </div>
    </div>
  </div>
</div>