<?php

$servidor = "localhost";
$usuario = "root";
$senha = "";
$banco = "budget_tracker";

$mensagem = "";
$erro = false;


if ($_SERVER["REQUEST_METHOD"] === "POST") {

    // Conecta ao MySQL sem selecionar um banco específico
    $conexao = new mysqli($servidor, $usuario, $senha);

    if ($conexao->connect_error) {

        $mensagem = "Não foi possível conectar ao MySQL: " . $conexao->connect_error;
        $erro = true;

    } else {

        // Cria o banco
        $sql = "CREATE DATABASE IF NOT EXISTS `$banco`
                CHARACTER SET utf8mb4
                COLLATE utf8mb4_general_ci";

        if (!$conexao->query($sql)) {

            $mensagem = "Erro ao criar o banco de dados: " . $conexao->error;
            $erro = true;

        } else {

            // Seleciona o banco
            $conexao->select_db($banco);


            // Tabela cadastro
            $sql = "CREATE TABLE IF NOT EXISTS cadastro (
                id INT(11) NOT NULL AUTO_INCREMENT,
                nome VARCHAR(100) DEFAULT NULL,
                email VARCHAR(100) DEFAULT NULL,
                senha VARCHAR(255) DEFAULT NULL,
                salario DECIMAL(10,2) DEFAULT NULL,
                telefone INT(11) DEFAULT NULL,
                PRIMARY KEY (id)
            ) ENGINE=InnoDB
            DEFAULT CHARSET=utf8mb4
            COLLATE=utf8mb4_general_ci";


            if (!$conexao->query($sql)) {

                $mensagem = "Erro ao criar a tabela cadastro: " . $conexao->error;
                $erro = true;

            } else {


                // Tabela lancamentos
                $sql = "CREATE TABLE IF NOT EXISTS lancamentos (
                    id INT(11) NOT NULL AUTO_INCREMENT,
                    responsavel_id INT(11) NOT NULL,
                    valor DECIMAL(10,2) NOT NULL,
                    tipo VARCHAR(20) NOT NULL,
                    data_lancamento DATETIME DEFAULT CURRENT_TIMESTAMP,
                    PRIMARY KEY (id)
                ) ENGINE=InnoDB
                DEFAULT CHARSET=utf8mb4
                COLLATE=utf8mb4_general_ci";


                if (!$conexao->query($sql)) {

                    $mensagem = "Erro ao criar a tabela lancamentos: " . $conexao->error;
                    $erro = true;

                } else {

                    $mensagem = "Instalação concluída com sucesso!";

                }
            }
        }

        $conexao->close();
    }
}

?>


<!DOCTYPE html>

<html lang="pt-BR">

<head>

    <meta charset="UTF-8">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Instalação - BudgetTracker v1.0</title>

    <style>

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        body {
            background-color: #f4f6f9;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .container {
            background-color: white;
            width: 100%;
            max-width: 500px;
            padding: 35px;
            border-radius: 12px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.06);
            text-align: center;
        }

        h1 {
            color: #2c3e50;
            margin-bottom: 10px;
        }

        p {
            color: #718096;
            margin-bottom: 25px;
        }

        button {
            width: 100%;
            padding: 14px;
            border: none;
            border-radius: 8px;
            background-color: #3182ce;
            color: white;
            font-size: 1rem;
            font-weight: bold;
            cursor: pointer;
        }

        button:hover {
            background-color: #2b6cb0;
        }

        .sucesso {
            margin-top: 20px;
            padding: 15px;
            border-radius: 8px;
            background-color: #c6f6d5;
            color: #276749;
        }

        .erro {
            margin-top: 20px;
            padding: 15px;
            border-radius: 8px;
            background-color: #fed7d7;
            color: #9b2c2c;
        }

    </style>

</head>


<body>

    <div class="container">

        <h1>BudgetTracker v1.0</h1>

        <p>
            Instalação do sistema
        </p>


        <?php if ($mensagem !== ""): ?>

            <div class="<?= $erro ? 'erro' : 'sucesso' ?>">

                <?= $mensagem ?>

            </div>

        <?php endif; ?>


        <?php if ($mensagem === "" || $erro): ?>

            <form method="post">

                <button type="submit">
                    Instalar BudgetTracker
                </button>

            </form>

        <?php else: ?>

            <p style="margin-top: 20px;">
                O banco de dados e as tabelas foram configurados.
            </p>

            <a href="dashboard/index.html">
                Ir para o sistema
            </a>

        <?php endif; ?>

    </div>

</body>

</html>