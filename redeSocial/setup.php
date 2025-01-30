<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Base de Dados</title>
</head>
<body>
    <h3>Criar Tabelas</h3>
    <?php // setup.php Este é que cria tabelas
        require_once 'funcoes.php';

        createTable('membros',
            'utilizador VARCHAR(16),
            password VARCHAR(16),
            INDEX(utilizador(6))');
        createTable('mensagens',
            'id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            autor VARCHAR(16),
            destin VARCHAR(16),
            tipomsg CHAR(1),
            hora INT UNSIGNED,
            mensagem VARCHAR(4096),
            INDEX(autor(6)),
            INDEX(destin(6))');
        createTable('amigos',
            'utilizador VARCHAR(16),
            amigo VARCHAR(16),
            INDEX(utilizador(6)),
            INDEX(amigo(6))');
        createTable('perfis',
            'utilizador VARCHAR(16),
            texto VARCHAR(4096),
            INDEX(utilizador(6))');
    ?>
</body>
</html>