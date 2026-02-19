<?php
session_start();
include 'connection.php';


if (!isset($_SESSION['usuario'])) {
    header('Location: login.php');
    exit();
}

if ($_GET['id']) {
    $produto_id = $_GET['id'];
}
$alerta = "";
$sql = "SELECT * FROM produtos WHERE ID=$produto_id";
$result = $conn->query($sql);
$produto = $result->fetch_assoc();

if (isset($_POST['comprar'])) {
    $sql = "SELECT estoque FROM produtos WHERE ID=$produto_id";
    $estoque = (int) $produto['estoque'];
    if ($estoque > 0) {
        $estoque_atual = $estoque - 1;
        $sql = "UPDATE produtos SET estoque =$estoque_atual WHERE ID=$produto_id";
        $conn->query($sql);
        $alerta = "Parabéns pela compra!";
/* 
        header("Location: produto.php/?id=$produto_id");
        exit(); */
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="../style.css">
    <title><?= $produto['nome']?></title>
</head>
<body>
    <header class="p-3 text-center border-bottom border-5 border-primary">
        <h1>Loja Eletronica</h1>
        
    </header>
    <main class="container-fluid col-12 mt-5">
        <div class="container-fluid col-12 p-3">
            <h2 class="col-12 text-nowrap ">Nome do Produto: <?= $produto['nome']?> </h2>
            <span class="container-fluid">
                <h3>Estoque do Produto: <?= $produto['estoque']?></h3>
                <form method="post">
                    <?php if($_SESSION['usuario']['tipo' ] !== 'admin'):?>
                    <button class="btn btn-success fw-bold" name="comprar">Comprar</button>
                    <?php else: ?>
                    <button class="btn btn-info fw-bold" name="comprar">Adicionar +1 ao estoque</button>
                    <?php endif;?>
                </form>
            </span>
        </div>
        <div class="container-fluid">
            <?php if (!empty($alerta)):?>
                <div class="alert alert-primary col-3">
                    <h4 class="display-9"><?= $alerta ?></h4>
                    <hr>
                    <p>Loja Eletrônica</p>
                </div>
            <?php endif; ?>
            <button class="btn btn-primary" onclick="location.href='../produtos.php'">Voltar</button>
        </div>
    </main>
</body>
</html>