<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Budget Tracker</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <h1>Dashboard</h1>
    </header>
    <main>
        <form action="<?=$_SERVER['PHP_SELF']?></form>" method="get">
            <label for="nome">Quem fará o lançamento?</label>
            <input type="text" name="nome" id="idnome">
            <label for="valor">Qual valor será lançado?</label>
            <input type="number" name="valor" id="idvalor">
            <label for="dado">É uma despesa ou uma entrada?</label>
            <input type="radio" name="dado" id="iddado" value="Entrada"> Entrada
            <input type="radio" name="dado" id="iddado" value="Despesa"> Despesa
        </form>
    </main>
</body>
</html>