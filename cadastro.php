<?php

session_start();
include 'connection.php';

if (isset($_SESSION['usuario'])) {
    header('Location: index.php');
    exit();
}

$senha_admins = 1234;

if ($_POST) {
    if (isset($_POST['cadastrar'])) {
        $nome = $_POST['nome'];
        $senha = $_POST['senha'];
        $tipo = $_POST['tipo'];

        $sql = "SELECT * FROM usuario WHERE nome='$nome'";
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            echo "você já tem cadastro";
            echo '<button class="btn btn-primary" onclick="location.href="cadastro.php""> Voltar </button>';
            return;
        } else {
            $sql = "INSERT INTO usuario (nome, senha, tipo) VALUES ('$nome','$senha','$tipo')";
            $conn->query($sql);
            header('Location: login.php');
            exit();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <title>Loja Eletronica - Cadastro</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header class="p-3 text-center">
        <h1>Loja Eletronica</h1>
    </header>
    <main class="d-flex flex-column justify-content-center align-items-center" style="height: 90vh;">
        <h2 class="text-center display-6">Cadastro:</h2>
        <form action="" method="post" class="d-flex flex-column col-6 p-3 h-75 justify-content-around align-items-center text-center fw-bold fs-5">
            <label for="nome">Digite um nome:</label>
            <input type="text" name="nome" id="nome" class="col-6">

            <label for="senha">Crie uma senha:</label>
            <input type="password" name="senha" id="senha" class="col-6">
            <label for="tipo">Selecione o tipo de usuário</label>
            <select name="tipo" id="tipo" class="col-6">
                <option value="" selected disabled>Selecione uma opção</option>
                <option value="usuario">Usuário</option>
                <option value="admin">Administrador</option>
            </select>
            <button class="btn btn-primary col-6 fw-bold p-3 fs-5" name="cadastrar" type="submit">Cadastrar</button>

        </form>

    </main>
</body>

</html>