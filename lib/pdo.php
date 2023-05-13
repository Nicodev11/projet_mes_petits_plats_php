<?php

try {
    $pdo = new PDO('mysql:dbname=mes_petits_plats;host=localhost;charset=utf8mb4', 'root', 'NicoJuju69007!');
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}