<?php

function setFlashMessage($message, $type)
{
    // Enregistrer le message et le type dans la session
    $_SESSION['flash_message'] = $message;
    $_SESSION['flash_type'] = $type;
}

function getFlashMessage()
{
    // Vérifier si un message flash existe dans la session
    if (isset($_SESSION['flash_message'])) {

        $message = $_SESSION['flash_message'];
        $type = $_SESSION['flash_type'];

        unset($_SESSION['flash_message']);
        unset($_SESSION['flash_type']);
          
       ?>
            <div class="alert alert-<?= $type ?> alert-dismissible fade show container mt-3" role="alert">
                <?=$message ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php
    }
    // Retourner une chaîne vide si aucun message flash n'est trouvé
    return '';
}
?>