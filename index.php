<!DOCTYPE html>
<html lang="pt-br">

<?php
session_start();

if (!isset($_SESSION["cygnus_login"])) {
    header("location:login.php");
    die;
};

?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/style.css">
</head>

<body>
    <div id="menu_principal">
        <h1>Projeto Cadastro de Vagas</h1>
        <div id="menu_inicio">
            <ul>
                <li>
                    <a href="./listagem_vaga.php">Listar Vagas</a>
                </li>
                <li>
                    <a href="./listagem_cliente.php">Listar Clientes</a>
                </li>
                <li>
                    <a href="./cadastro_vaga.php">Cadastrar Vaga</a>
                </li>
                <li>
                    <a href="./cadastro_cliente.php">Cadastrar Cliente</a>
                </li>
                <li>
                    <a href="./logout.php">Sair</a>
                </li>
            </ul>
        </div>
    </div>
</body>

</html>