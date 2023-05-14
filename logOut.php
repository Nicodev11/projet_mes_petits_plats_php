<?php 
session_start();

if (!isset($_SESSION['user'])) {
  header("location: signUp.php");
  exit;
}

unset($_SESSION['user']);

header("location: index.php");