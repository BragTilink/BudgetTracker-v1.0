<?php
    require_once "../php_contabil/accounting.php";

    /** @var float $saldo */
/** @var float $despesas */
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Budget Tracker v1.0</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <!-- Header com nome do projeto e usuário logado -->
    <header class="top-bar">
        <h1>Budget Tracker v1.0</h1>
        <div class="user-info">
            Usuário: <span class="user-name"><?= $_SESSION['nome'] ?></span>
        </div>
    </header>
    <div class="container">

        <!-- Grid com os Indicadores Financeiros -->
        <section class="cards-grid">
            
            <!-- Painel: Saldo Atual -->
            <div class="card">
                <h2>Saldo Atual</h2>
                <div class="valor saldo">R$ <?= number_format($saldo, 2, ',', '.') ?></div>
            </div>

            <!-- Painel: Gasto até o momento -->
            <div class="card">
                <h2>Gastos até o Momento</h2>
                <div class="valor gastos">R$ <?= number_format($despesas, 2, ',', '.') ?></div>
            </div>

        </section>

        <!-- Seção com o Atalho para o Formulário de Lançamento -->
        <section class="card">
            <h2>Ações Rápidas</h2>
            <a href="home.php" class="btn-link">Fazer novo lançamento</a>
        </section>

    </div>

</body>
</html>