<html>
<head>
    <title>Editar</title>
    <style type="text/css">
        input {
            display: block;
            margin-bottom: 1em;
            padding: 5px;
        }
    </style>
</head>
<body>
    <p><a href="index.php">Home</a></p>
    <?php
        // Recebe os dados a serem editados
        $id = filter_input(INPUT_POST, 'id');
        $name = filter_input(INPUT_POST, 'name');
        $dateBirth = filter_input(INPUT_POST, 'dateBirth');
        $sex = filter_input(INPUT_POST, 'sex');
        $address = filter_input(INPUT_POST, 'address');
        $email = filter_input(INPUT_POST, 'email');
        $phone = filter_input(INPUT_POST, 'phone');
        $sns = filter_input(INPUT_POST, 'sns');
        $nif = filter_input(INPUT_POST, 'nif');
    ?>
    
    <h2>Alteração de Dados</h2>
    <!-- Chama o ficheiro salvar.php -->
    <form action="salvar.php" method="post">
        <input type="hidden" name="id" value="<?php echo htmlspecialchars($id); ?>"> <!-- Campo escondido para o ID -->
        <label>Nome:</label>
        <input type="text" name="name" value="<?php echo htmlspecialchars($name); ?>" required>
        <label>Data de Nascimento:</label>
        <input type="date" name="dateBirth" value="<?php echo htmlspecialchars($dateBirth); ?>" required>
        <label>Sexo:</label>
        <input type="text" name="sex" value="<?php echo htmlspecialchars($sex); ?>" required>
        <label>Endereço:</label>
        <input type="text" name="address" value="<?php echo htmlspecialchars($address); ?>">
        <label>Email:</label>
        <input type="email" name="email" value="<?php echo htmlspecialchars($email); ?>">
        <label>Telefone:</label>
        <input type="text" name="phone" value="<?php echo htmlspecialchars($phone); ?>">
        <label>SNS:</label>
        <input type="text" name="sns" value="<?php echo htmlspecialchars($sns); ?>">
        <label>NIF:</label>
        <input type="text" name="nif" value="<?php echo htmlspecialchars($nif); ?>">
        <input type="submit" value="Guardar Alterações">
    </form>
</body>
</html>
