<?php 
session_start();
include 'connection.php';

if(!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit();
}

$sql = "SELECT * from produtos";
$produtos = $conn->query($sql);

?>


<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header class="p-5 w-100 text-center"><h1>Produtos</h1></header>
    <main>
        <div><h2 class="text-center mb-5">Compre aqui, <?= $_SESSION['usuario']['nome']?>!</h2></div>
        <div class="container-fluid d-flex flex-wrap gap-5 justify-content-center">
            <?php while ($produto = $produtos->fetch_assoc()) :?>
                <div class="card rounded-2 col-2 bg-primary text-center fw-800 text-white p-5" onclick="location.href='produto.php/?id=<?=$produto['ID']?>'">
                    <p><?= $produto['nome']?></p>
                    <span class="d-flex gap-3 w-100 justify-content-center mt-4">
                        <p>Estoque: <?= $produto['estoque']?></p>
                        <p>R$<?= $produto['preco']?></p>
                    </span>
                    <p>Categoria: <?= $produto['categoria']?></p>
                </div>
            <?php endwhile;?>
        </div>
    </main>
</body>
</html>