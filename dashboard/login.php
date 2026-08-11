<?php

    require_once "../database/database.php";

    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $sql = "SELECT * FROM cadastro
            WHERE email = ? AND senha = ?";

    $stmt = $conexao->prepare($sql);

    $stmt->bind_param("ss", $email, $senha);

    $stmt->execute();

    $resultado = $stmt->get_result();

    if ($resultado->num_rows == 1) {

        $usuario = $resultado->fetch_assoc();

        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['nome'] = $usuario['nome'];

        header("Location: dashboard.php");
        exit;

    } else {

        echo "E-mail ou senha incorretos.";

    }