<?php 
session_start();
include 'connection.php';

if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit();
}

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header class="w-100 text-center p-2">
        <h1 class="h5">Loja de Produtos</h1>
    </header>
    <main>
        <h1 class="display-5 text-center">Olá, <?= $_SESSION['usuario']['nome']?>!</h1>
        <div class="container-fluid col-12 d-flex p-5">
            <div class="container p-3 col-5 bg-primary" onclick="location.href='produtos.php'">produtos</div>
            <div class="container p-3 col-5 bg-secundary "onclick="location.href='armazem.php'">armazém</div>
        </div>
        <div>
            <button onclick="location.href='logout.php'">Logout</button>
        </div>
    </main>
    

</body>
</html>