<?php
    require_once 'functions.php';

    if (isset($_POST['utilizador']))
    {
        $utilizador = ($_POST['utilizador']);
        $result = queryMysql("SELECT * FROM membros WHERE utilizador='$utilizador'");
        if ($result->num_rows)
            echo "<span class='taken'>&nbsp;&#x2718; " .
                "Este nome de utilizador já está em uso</span>";
        else
            echo "<span class='available'>&nbsp;&#x2714; " .
                "Este nome de utilizador está disponível</span>";
    }
?>