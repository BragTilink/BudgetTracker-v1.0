<?php 
    require_once "../database/database.php";

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $salario = $_POST['renda'];
    $telefone = $_POST['telefone'];

    $sql = "INSERT INTO cadastro (nome, email, senha, salario, telefone)
        VALUES ('$nome', '$email', '$senha', '$salario', '$telefone')";

    $conexao->query($sql);

    if ($conexao->query($sql)) {
    header("Location: home.php");
    exit;
    }
    
?>