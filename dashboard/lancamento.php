<?php 

    require_once "../database/database.php";

    $responsavel = $_POST['responsavel'];
    $valor = $_POST['valor'];
    $tipo = $_POST['tipo_transacao'];

    $sql = "INSERT INTO lancamentos (responsavel_id, valor, tipo)
        VALUES (?, ?, ?)";

    $stmt = $conexao->prepare($sql);

    $stmt->bind_param("ids", $responsavel, $valor, $tipo);

    $stmt->execute();

    if($stmt->execute()){
        header("Location: dashboard.html");
    }
?>