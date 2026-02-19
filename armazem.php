<?php

session_start();
include 'connection.php';

$mensagem = "";

if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit();
} else if ($_SESSION['usuario']['tipo'] !== 'admin') {
    header('Location: index.php');
    exit();
} else {
    $mensagem = "Você é um admin!";
}

$sql = "SELECT * FROM produtos";
$result = $conn->query($sql);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <header class="text-center p-3">
        <h1>Armazém</h1>
    </header>
    <main>
        <h2 class="text-center">Armazém - Edite os produtos da Loja Eletrônica</h2>
        <div class="container-fluid d-flex flex-wrap gap-5 justify-content-center">
            <?php while ($produto = $result->fetch_assoc()): ?>
                <div class="card rounded-2 col-2 bg-primary text-center fw-800 text-white p-5" onclick="location.href='produto.php/?id=<?= $produto['ID'] ?>'">
                    <p><?= $produto['nome'] ?></p>
                    <span class=" container-fluid">
                    <p>Estoque: <?= $produto['estoque'] ?></p>
                    <p>Preço <?= $produto['preco'] ?></p>
                    </span>
                </div>
                
            <?php endwhile; ?>
        </div>
    </main>
</body>

</html>