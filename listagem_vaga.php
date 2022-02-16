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

$lista_vaga = "SELECT * FROM tb_vaga ";
$query_send = mysqli_query($conect, $lista_vaga);

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
</head>

<body>
    <header>

    </header>
    <main>

        <div id="lista">
            <h2>Listagem de vagas</h2>
            <div class="listagem">
                <ul>
                    <li>Função</li>
                    <li>Tipo</li>
                    <li>Local de Trabalho</li>
                    <li>Status</li>
                    <li></li>

                </ul>

                <?php
                while ($linha = mysqli_fetch_assoc($query_send)) {
                ?>

                    <ul>
                        <li><?php echo $linha['funcao'] ?></li>
                        <li><?php if ($linha['tipo'] == 'E') {
                                echo 'Efetiva';
                            } elseif ($linha['tipo'] == 'T') {
                                echo 'Temporária';
                            } ?></li>
                        <li><?php echo $linha['localTrab'] ?></li>
                        <li><?php if ($linha['fechamento'] == 'A') {
                                echo 'Aberta';
                            } elseif ($linha['fechamento'] == 'P') {
                                echo 'Preenchida';
                            } elseif ($linha['fechamento'] == 'C') {
                                echo 'Cancelada';
                            } elseif ($linha['fechamento'] == 'F') {
                                echo 'Fechada';
                            }
                            ?></li>
                        <li><a href="./detalha_vaga.php?vaga=<?php echo $linha['IDVAGA'] ?>&edit=disabled">Detalhes</a></li>
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