<?php
    $url = 'https://www.epb.pt';

    //Remove caracteres ilegais
    $url = filter_var($url, FILTER_SANITIZE_URL);

    // Valida a url
    if (!filter_var($url, FILTER_VALIDATE_URL) === false) {
        echo("$url é uma URL valida");
    } else {
        echo("$url não é um URL valida");
    }
?>