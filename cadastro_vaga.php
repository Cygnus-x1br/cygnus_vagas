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

$consulta_cliente = 'SELECT * FROM tb_cliente';
$query_send_cli = mysqli_query($conect, $consulta_cliente);
if (!$query_send_cli) {
    die('Falha na conexão');
}

if (isset($_POST['funcao'])) {
    if (!empty($_POST['funcao'])) {
        $funcao = $_POST['funcao'];
    } else {
        die('Digite a função da vaga');
    }
    if (!empty($_POST['tipo'])) {
        $tipo = $_POST['tipo'];
    } else {
        die('Selecione o tipo de vaga');
    }
    if (!empty($_POST['local_trab'])) {
        $local = $_POST['local_trab'];
    } else {
        die('Digite o local de trabalho');
    }
    $escolaridade = $_POST['escolaridade'];
    $horario = $_POST['horario'];
    $beneficios = $_POST['beneficios'];
    $descricao = $_POST['descricao'];
    if (!empty($_POST['cliente'])) {
        $cliente = $_POST['cliente'];
    } else {
        die('Selecione ou cadastre o Cliente');
    }

    $insere_vaga = "INSERT INTO tb_vaga ";
    $insere_vaga .= "VALUES(null, '$funcao', '$tipo', '$local', '$escolaridade', '$horario', '$beneficios', '$descricao', $cliente, now(),'A', null)";
    $query_send = mysqli_query($conect, $insere_vaga);
    header("location:listagem_vaga.php");
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
        <h2>Cadastro de vagas</h2>

    </header>
    <main>

        <div id="formulario">

            <form action="cadastro_vaga.php" method="POST">

                <input type="text" name="funcao" placeholder="Função">
                <div class="radio">
                    <input type="radio" name="tipo" id='efetivo' value='E'>
                    <label for="efetivo">Efetiva</label>
                    <input type="radio" name="tipo" id='temporario' value='T'>
                    <label for="temporario">Temporária</label>
                </div>
                <input type="text" name="local_trab" placeholder="Local de Trabalho">
                <input type="text" name="escolaridade" placeholder="Escolaridade">
                <input type="text" name="horario" placeholder="Horário de trabalho">
                <input type="text" name="beneficios" placeholder="Beneficios">
                <textarea name="descricao" placeholder="Descrição atividades" id=""></textarea>
                <select name="cliente" id="">
                    <?php
                    while ($show_cliente = mysqli_fetch_assoc($query_send_cli)) {
                    ?>
                        <option value="<?php echo $show_cliente['IDCLIENTE'] ?>"><?php echo $show_cliente['nomeCliente'] ?></option>
                    <?php
                    }
                    ?>
                </select>
                <div class="btn">
                    <a href="./cadastro_cliente.php">Cadastro Cliente</a>
                </div>
                <input type="submit" value="Adicionar vaga">
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