<?php
require_once('../../_conexoes/cygnus_php_conexao.php');
?>
<?php

session_start();

if (isset($_POST['usuario'])) {
    $usuario = $_POST["usuario"];
    $senha = $_POST["senha"];
    $login = "SELECT * FROM tb_user ";
    $login .= " WHERE username = '{$usuario}' AND passwd = MD5('{$senha}')";
    $usrLogin = mysqli_query($conect, $login);
    if (!$usrLogin) {
        die('Falha na conexão');
    }
    $show = mysqli_fetch_assoc($usrLogin);
    if (empty($show)) {
        $message = 'Digite um nome de usuario ou senha validos';
    } else {
        $_SESSION["cygnus_login"] = $show["IDUSUARIO"];
        header("location:index.php");
        $message = 'Bem vindo';
    }
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

</head>

<body>
    <header>
        <h2>Tela de Login</h2>

    </header>
    <main>
        <div id="formulario">
            <form action="login.php" method="POST">
                <input type="text" name="usuario" placeholder="Usuário">
                <input type="password" name="senha" placeholder="Senha">
                <input type="submit" value="Login">
                <!-- <input type="image" src="./_assets/fig_botao_login.gif" alt=""> -->
                <?php
                if (isset($message)) {
                    echo "<p> $message </p>";
                }


                ?>
            </form>
        </div>
    </main>


</body>

</html>