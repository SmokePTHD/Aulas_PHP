<?php
    $email = 'maria silva@exemplo.com';

    //Remove caracteres ilegais
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);

    // Valida a url
    if (!filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
        echo("$email é um email valido");
    } else {
        echo("$email não é um Email valido");
    }
?>