<?php
    $int = 2;
    //vai verificar se é inteiro
    if (filter_var($int, FILTER_VALIDATE_INT) === 0 || !filter_var($int, FILTER_VALIDATE_INT) === false) {
        echo("$int é um inteiro válido");
    } else {
        echo("$int não é inteiro válido");
    }
?>