<?php
require_once('../../_conexoes/cygnus_php_conexao.php');

?>
<?php
session_start();

if (!isset($_SESSION["cygnus_login"])) {
    header("location:login.php");
    die;
};

?>


<?php

if (isset($_POST['nomeCliente'])) {
    if (!empty($_POST['nomeCliente'])) {
        $nomeCliente = $_POST['nomeCliente'];
    } else {
        die('Digite o Nome do Cliente');
    }
    $endereco = $_POST['endereco'];
    $bairro = $_POST['bairro'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];
    $CNPJ = $_POST['CNPJ'];
    $contato = $_POST['contato'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];

    $insere_cliente = "INSERT INTO tb_cliente ";
    $insere_cliente .= "VALUES(null, '$nomeCliente', '$endereco', '$bairro', '$cidade', '$estado', '$CNPJ', '$contato', '$email', '$telefone')";
    $query_send = mysqli_query($conect, $insere_cliente);
}
?>



<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/style.css">
    <style>
        <?php

        ?>
    </style>
</head>

<body>
    <header>

        <h2>Cadastro de Clientes</h2>
    </header>
    <main>

        <div id="formulario">

            <form action="cadastro_cliente.php" method="POST">

                <input type="text" name="nomeCliente" placeholder="Razão Social">
                <input type="text" name="endereco" placeholder="Endereço">

                <input type="text" name="bairro" placeholder="Bairro">
                <input type="text" name="cidade" placeholder="Cidade">
                <input type="text" name="estado" placeholder="Estado">
                <input type="text" name="CNPJ" placeholder="CNPJ">
                <input type="text" name="contato" placeholder="Contato">
                <input type="text" name="email" placeholder="E-Mail">
                <input type="text" name="telefone" placeholder="Telefone">
                <input type="submit" value="Adicionar cliente">
            </form>
        </div>

    </main>
    <div class="opcoes">

        <div class="btn">
            <a href="./index.php">Voltar ao Inicio</a>
        </div>
    </div>

</body>

</html>