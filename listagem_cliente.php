<?php

session_start();

require_once('../../_conexoes/cygnus_php_conexao.php');


if (!isset($_SESSION["cygnus_login"])) {
    header("location:login.php");
    die;
};

?>

<?php

if (isset($_POST['fechamento'])) {
    $fech = $_POST['fechamento'];
}


$consulta_cliente = 'SELECT * FROM tb_cliente';
$query_send_cli = mysqli_query($conect, $consulta_cliente);
if (!$query_send_cli) {
    die('Falha na conexão');
}
// $show_cliente = mysqli_fetch_assoc($query_send_cli);
$conta_vagas = "SELECT c.IDCLIENTE, c.nomeCliente, c.contato, c.telefone, count(v.ID_CLIENTE) as vagas_cliente FROM tb_cliente as c";
$conta_vagas .= " LEFT JOIN tb_vaga as v ";
$conta_vagas .= " ON c.IDCLIENTE = v.ID_CLIENTE ";
if (!empty($fech)) {
    $conta_vagas .= " WHERE v.fechamento LIKE '{$fech}'";
}
$conta_vagas .= " GROUP BY(c.IDCLIENTE)";
// $query_count = mysqli_query($conect, $conta_vagas);

// $lista_vaga = "SELECT * FROM tb_cliente ";
// $insere_vaga .= "VALUES(null, '$funcao', '$tipo', '$local', '$escolaridade', '$horario', '$beneficios', '$descricao', $cliente, now(),'$fechamento', null)";
$query_send = mysqli_query($conect, $conta_vagas);

?>



<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="./css/lista.css">
    <style>
        <?php

        ?>
    </style>
</head>

<body>
    <header>

    </header>
    <main>

        <div id="lista">
            <h2>Listagem de clientes</h2>
            <div class="selecao">
                <form id="select" action="./listagem_cliente.php" method="POST">
                    <input type="radio" name="fechamento" id="aberta" value='A'>
                    <label for="aberta">Aberta</label>
                    <input type="radio" name="fechamento" id="preenchida" value='P'>
                    <label for="preenchida">Preenchida</label>
                    <input type="radio" name="fechamento" id="cancelada" value='C'>
                    <label for="cancelada">Cancelada</label>
                    <input type="radio" name="fechamento" id="aberta" value='F'>
                    <label for="fechada">Fechada</label>
                    <input type="submit" value="Filtrar">
                </form>
            </div>
            <div class="listagem">
                <ul>
                    <li>Razão Social</li>
                    <li>Contato</li>
                    <li>Telefone</li>
                    <li>Vagas em Aberto</li>
                    <li></li>

                </ul>

                <?php
                while ($linha = mysqli_fetch_assoc($query_send)) {
                ?>

                    <ul>
                        <li><?php echo $linha['nomeCliente'] ?></li>
                        <li><?php echo $linha['contato'] ?></li>
                        <li><?php echo $linha['telefone'] ?></li>
                        <li><?php echo $linha['vagas_cliente'] ?></li>
                        <li><a href="./detalha_cliente.php?cliente=<?php echo $linha['IDCLIENTE'] ?>&edit=disabled">Detalhes</a></li>
                    </ul>

                <?php
                }
                ?>
            </div>
            <div class="opcoes">

                <div class="btn">
                    <a href="./index.php">Voltar ao Inicio</a>
                </div>
            </div>
        </div>

    </main>

</body>

</html>