<?php

/*
    Ajout d'un utilisateur dans la base de données
*/

function saveUser(PDO $pdo, string $firstname, string $lastname, string $email, string $password, string $city) {
    $query = $pdo->prepare("INSERT INTO users (firstname, lastname, email, password, city) "
                    ."VALUES(:firstname, :lastname, :email, :password, :city)");
    
    $query->bindParam(':firstname', $firstname, PDO::PARAM_STR);
    $query->bindParam(':lastname', $lastname, PDO::PARAM_STR);
    $query->bindParam(':password', $password, PDO::PARAM_STR);
    $query->bindParam(':email', $email, PDO::PARAM_STR);
    $query->bindParam(':city', $city, PDO::PARAM_STR);

    return $query->execute();
}