<?php
    $ip = '127.0.01';

    if (!filter_var($ip, FILTER_VALIDATE_IP) === 0 || !filter_var($ip, FILTER_VALIDATE_IP) === false) {
        echo("$ip é um IP valido");
    } else {
        echo("$ip não é um IP valido");
    }
?>