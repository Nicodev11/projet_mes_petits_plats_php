<?php
session_start();

require_once './templates/header.php';


if (isset($_SESSION['user'])) {?>
   <h1><?=  $_SESSION['user']['firstname'] ?></h1><?php
}

?>


<?php

require_once './templates/footer.php';