<?php
    require_once "../database/database.php";


    // 1. Usuário logado
    $usuario_id = $_SESSION['usuario_id'];


    // 2. Buscar salário
    $sql = "SELECT salario FROM cadastro WHERE id = ?";

    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("i", $usuario_id);
    $stmt->execute();

    $resultado = $stmt->get_result();

    $usuario = $resultado->fetch_assoc();

    $salario = $usuario['salario'];


    // 3. Buscar lançamentos
    $sql = "SELECT * FROM lancamentos WHERE responsavel_id = ?";

    $stmt = $conexao->prepare($sql);
    $stmt->bind_param("i", $usuario_id);
    $stmt->execute();

    $resultado = $stmt->get_result();


    // 4. Separar entradas e despesas
    $entrada = 0;
    $despesas = 0;

    while ($lancamento = $resultado->fetch_assoc()) {

        if ($lancamento['tipo'] == 'entrada') {
            $entrada += $lancamento['valor'];
        }

        if ($lancamento['tipo'] == 'despesa') {
            $despesas += $lancamento['valor'];
        }
    }


    // 5. Calcular saldo
    $saldo = $salario + $entrada - $despesas;

?>