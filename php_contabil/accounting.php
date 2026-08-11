<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once "../database/database.php";


// Usuário logado
$usuario_id = $_SESSION['usuario_id'];


// Buscar o salário do usuário
$sql = "SELECT salario FROM cadastro WHERE id = ?";

$stmt = $conexao->prepare($sql);
$stmt->bind_param("i", $usuario_id);
$stmt->execute();

$resultado = $stmt->get_result();

$usuario = $resultado->fetch_assoc();

$salario = $usuario['salario'];


// Buscar os lançamentos do usuário
$sql = "SELECT * FROM lancamentos WHERE responsavel_id = ?";

$stmt = $conexao->prepare($sql);
$stmt->bind_param("i", $usuario_id);
$stmt->execute();

$resultado = $stmt->get_result();


// Inicializar valores
$entrada = 0;
$despesas = 0;

$lancamentos = [];


// Percorrer os lançamentos
while ($lancamento = $resultado->fetch_assoc()) {

    // Guarda o lançamento para o histórico do dashboard
    $lancamentos[] = $lancamento;


    // Soma as entradas
    if ($lancamento['tipo'] == 'entrada') {
        $entrada += $lancamento['valor'];
    }


    // Soma as despesas
    if ($lancamento['tipo'] == 'despesa') {
        $despesas += $lancamento['valor'];
    }
}


// Calcular saldo
$saldo = $salario + $entrada - $despesas;

?>