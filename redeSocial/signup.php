<?php
    ini_set('display_errors', 1);
    error_reporting(E_ALL);
 
    include './header.php';
    include './database.php';

    echo <<< _END
    <script>
        function checkUser(utilizador) {
            if (utilizador.value === '') {
                $('#used').html('&nbsp;');
                return;
            }
            
            $.post('checkuser.php', { utilizador: utilizador.value }, function(data) {
                $('#used').html(data);
            });
        }
    </script>  
    _END;

    $error = $utilizador = $password = $sexo = "";
    if (isset($_SESSION['utilizador'])) destroiSessao();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $utilizador = trim($_POST['utilizador']);
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $sexo = $_POST['sexo'];
        
        $checkUserStmt = $ligacao->prepare("SELECT * FROM membros WHERE utilizador = ?");
        $checkUserStmt->bind_param("s", $utilizador);
        $checkUserStmt->execute();
        $result = $checkUserStmt->get_result();
        
        if ($result->num_rows > 0) {
            echo "<p>Esse nome de utilizador já existe!</p>";
        } else {
            $uploadDir = 'uploads/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            $fotoPath = ($sexo === 'F') ? 'uploads/defaultW.jpg' : 'uploads/defaultM.jpg';

            if (!empty($_FILES['foto']['name']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
                $extensao = strtolower(pathinfo($_FILES['foto']['name'], PATHINFO_EXTENSION));
                $extensoesPermitidas = ['jpg', 'jpeg', 'png', 'gif'];

                if (in_array($extensao, $extensoesPermitidas)) {
                    $fotoNome = uniqid() . '.' . $extensao;
                    $fotoPath = $uploadDir . $fotoNome;

                    if (move_uploaded_file($_FILES['foto']['tmp_name'], $fotoPath)) {
                        echo "Imagem salva com sucesso.";
                    } else {
                        echo "Erro ao salvar a imagem.";
                    }
                } else {
                    echo "Formato inválido. Apenas JPG, PNG e GIF são permitidos.";
                }
            }

            if (!empty($utilizador) && !empty($password) && !empty($sexo)) {
                $status = 1;
                $stmt = $ligacao->prepare("INSERT INTO membros (utilizador, password, sexo, foto, status) VALUES (?, ?, ?, ?, ?)");
                $stmt->bind_param("ssssi", $utilizador, $password, $sexo, $fotoPath, $status);
                
                if ($stmt->execute()) {
                    $_SESSION['utilizador'] = $utilizador;
                    $_SESSION['password'] = $password;
                    
                    setcookie("utilizador", $utilizador, time() + (86400 * 30), "/");
                    setcookie("password", $password, time() + (86400 * 30), "/"); 
                    
                    header("Location: membros.php?view=$utilizador");
                } else {
                    echo "<p>Erro ao registrar: " . $stmt->error . "</p>";
                }
                $stmt->close();
            } else {
                echo "<p>Preencha todos os campos corretamente.</p>";
            }
        }
        $checkUserStmt->close();
    }
    echo <<< __END
    <form method="post" action="signup.php" enctype="multipart/form-data">
        <label>Nome de utilizador:</label>
        <input type="text" name="utilizador" required onBlur="checkUser(this)">
        <div id="used">&nbsp;</div>
        
        <label>Password:</label>
        <input type="password" name="password" required>
        
        <label>Sexo:</label>
        <select name="sexo">
            <option value="M">Masculino</option>
            <option value="F">Feminino</option>
        </select>
        
        <label>Foto de perfil:</label>
        <input type="file" name="foto" accept="image/*">
        
        <input type="submit" value="Registar">
    </form>
    __END;
    exit;
?>
