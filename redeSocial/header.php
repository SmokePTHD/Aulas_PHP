<?php
    session_start();
    // folhas de estilo e javascript
    echo <<<_INIT
<!DOCTYPE html>
<html>
    <head>
        <meta charset='utf-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <!-- jQuery via CDN -->
        <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
        <link rel='stylesheet' href='styles.css' type='text/css'>
        <script src='javascript.js'></script>
_INIT;
 
    require_once 'funcoes.php';
    $userstr = 'Bem-Vindo';
    if (isset($_SESSION['utilizador'])) {
        $utilizador = $_SESSION['utilizador'];
        $loggedin = TRUE;
        $userstr = "Ativo como: $utilizador";
    } else {
        $loggedin = FALSE;
    }
 
    echo <<<_MAIN
        <title> gpsi22: $userstr </title>
    </head>
    <body>
        <div data-role='page'> <!-- Isto é jquery -->
            <div data-role='header'>
                <div id='logo' class='center'><img id='gpsi22' src='gpsi20.gif'>gpsi22</div>
                <div class='username'>$userstr</div>
            </div>
            <div data-role='content'>
_MAIN;
 
    if ($loggedin) {
        // se tiver registado
        echo <<<_REGISTADO
                <div class='center'>
                    <a data-role='button' data-inline='true' data-icon='home' data-transition="slide" href="index.php?view=$utilizador">Home</a>
                    <a data-role='button' data-inline='true' data-icon='user' data-transition="slide" href="membros.php">Membros</a>
                    <a data-role='button' data-inline='true' data-icon='heart' data-transition="slide" href="amigos.php">Amigos</a><br />
                    <a data-role='button' data-inline='true' data-icon='mail' data-transition="slide" href="mensagens.php">Mensagens</a>
                    <a data-role='button' data-inline='true' data-icon='edit' data-transition="slide" href="perfil.php">Editar Perfil</a>
                    <a data-role='button' data-inline='true' data-icon='action' data-transition="slide" href="logout.php">Sair</a>
                </div>
_REGISTADO;
    } else {
        // se não tiver registado
        echo <<<_VISITA
                <div class='center'>
                    <a data-role='button' data-inline='true' data-icon='home' data-transition="slide" href="index.php">Home</a>
                    <a data-role='button' data-inline='true' data-icon='plus' data-transition="slide" href="signup.php">Registar</a>
                    <a data-role='button' data-inline='true' data-icon='check' data-transition="slide" href="index.php">Entrar</a>
                </div>
                <p class='info'>(Tem de estar registado para entrar no site)</p>
_VISITA;
    }
?>
            </div>
        </body>
    </html>
 
 