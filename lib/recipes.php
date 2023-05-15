<?php 

function saveRecipe(PDO $pdo, string $title, string $description = null, string $ingredients, string $instructions, int $category_id, int $user_id, string $image = null) {
  $query = $pdo->prepare("INSERT INTO recipes (title, description, ingredients, instructions, category_id, user_id, image) "
                  ."VALUES(:title, :description, :ingredients, :instructions, :category_id, :user_id, :image)");
  
  $query->bindParam(':title', $title, PDO::PARAM_STR);
  $query->bindParam(':description', $description, PDO::PARAM_STR);
  $query->bindParam(':ingredients', $ingredients, PDO::PARAM_STR);
  $query->bindParam(':instructions', $instructions, PDO::PARAM_STR);
  $query->bindParam(':category_id', $category_id, PDO::PARAM_INT);
  $query->bindParam(':user_id', $user_id, PDO::PARAM_INT);
  $query->bindParam(':image', $image, PDO::PARAM_STR);

  return $query->execute();

}

function updateRecipe(PDO $pdo, string $title, string $description, string $ingredients, string $instructions, int $category_id, string $image = null, int $id) {
  $query = $pdo->prepare("UPDATE recipes SET title = :title, description = :description, ingredients = :ingredients, instructions = :instructions, category_id = :category_id, image = :image WHERE id = :id");
  
  $query->bindParam(':id', $id, PDO::PARAM_INT);
  $query->bindParam(':title', $title, PDO::PARAM_STR);
  $query->bindParam(':description', $description, PDO::PARAM_STR);
  $query->bindParam(':ingredients', $ingredients, PDO::PARAM_STR);
  $query->bindParam(':instructions', $instructions, PDO::PARAM_STR);
  $query->bindParam(':category_id', $category_id, PDO::PARAM_INT);
  $query->bindParam(':image', $image, PDO::PARAM_STR);

  return $query->execute();

}

function deleteRecipes(PDO $pdo, INT $id) {
  $query = $pdo->prepare("DELETE FROM recipes WHERE id = :id");
  $query->bindParam(':id', $id, PDO::PARAM_INT);
  $query->execute();
}

function getRecipeByUserId(PDO $pdo, int $user_id) {
  $query = $pdo->prepare("SELECT * FROM recipes WHERE user_id = :user_id");
  $query->bindParam(':user_id', $user_id, PDO::PARAM_INT);
  $query->execute();

  return $query->fetchAll();
}

function getRecipeById(PDO $pdo, int $id) {
  $query = $pdo->prepare("SELECT * FROM recipes WHERE id = :id");
  $query->bindParam(':id', $id, PDO::PARAM_INT);
  $query->execute();

  return $query->fetchAll();
}

function getRecipes(PDO $pdo, int $limit = null) {

  $sql = "SELECT * FROM recipes ORDER BY id DESC";

  if ($limit) {
      $sql .= " LIMIT :limit";
  }

  $query = $pdo->prepare($sql);

  if ($limit) {
      $query->bindParam(':limit', $limit, PDO::PARAM_INT);
  }

  $query->execute();
  return $query->fetchAll();
}

function getRecipeImage($image) {
  if ($image == null) {
      $imagePath = _PATH_ASSETS_IMAGES_.'recipe_default.jpg';
  } else {
      $imagePath =  _PATH_RECIPES_UPLOAD_.$image;
  }
  return $imagePath;
}