<?php

session_start();


/* if (isset($_SESSION['usuario'])) {
    header('Location: index.php');
    exit();
}
 */
$error_message = "";

if ($_POST) {
    include 'connection.php';

    $nome = $_POST['nome'];
    $senha = $_POST['senha'];

    $sql = "SELECT * FROM usuario WHERE nome = '$nome' AND senha = '$senha'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $dados_usuario = $result->fetch_assoc();
        $_SESSION['usuario'] = $dados_usuario;
        header("Location: index.php");
        exit();
    } else {
        $error_message = "mano, nao foi encontrado nada com esse nome";
    }
    
    
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form action="" method="post">
        <label for="nome">Nome</label> <br>
        <input type="text" name="nome" id="nome">
        <br><br>
        <label for="senha">senha</label> <br>
        <input type="password" name="senha" id="senha"> <br>
        <button name="add" type="submit">Enviar</button>
    </form>
    <?= $error_message ?>
</body>
</html>