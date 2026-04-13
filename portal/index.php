<?php
include 'backend/conexao.php';
include 'backend/funcoes.php';
?>
<!DOCTYPE html>
<html>

<head>
    <title>Arte News</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <?php include 'navbar.php'; ?>

    <div class="container mt-4">

        <h2 class="titulo-secao">Últimas Notícias</h2>

        <form method="get" class="mb-4">
            <select name="cat" class="form-control">
                <option value="">Todas as categorias</option>
                <option value="1">Teatro</option>
                <option value="2">Cinema</option>
                <option value="3">Música</option>
            </select>

            <button class="btn btn-main mt-2">Filtrar</button>
        </form>

        <?php
        $cat = $_GET['cat'] ?? null;

        if ($cat) {
            $stmt = $pdo->prepare("
        SELECT n.*, u.nome, c.nome as categoria 
        FROM noticias n 
        JOIN usuarios u ON u.id=n.autor
        JOIN categorias c ON c.id=n.categoria_id
        WHERE n.categoria_id=?
        ORDER BY n.data DESC
    ");
            $stmt->execute([$cat]);
        } else {
            $stmt = $pdo->query("
        SELECT n.*, u.nome, c.nome as categoria 
        FROM noticias n 
        JOIN usuarios u ON u.id=n.autor
        JOIN categorias c ON c.id=n.categoria_id
        ORDER BY n.data DESC
    ");
        }
        ?>

        <div class="row">

            <?php foreach ($stmt as $n): ?>

                <div class="col-md-4 mb-4">

                    <div class="card h-100">

                        <?php if ($n['imagem']): ?>
                            <img src="imagens/<?= $n['imagem'] ?>" class="card-img-top">
                        <?php endif; ?>

                        <div class="card-body">

                            <h3><?= proteger($n['titulo']) ?></h3>

                            <p><?= resumo($n['noticia']) ?></p>

                            <small>
                                <?= $n['nome'] ?> • <?= $n['categoria'] ?> • <?= date('d/m/Y', strtotime($n['data'])) ?>
                            </small>

                            <br>

                            <a href="noticia.php?id=<?= $n['id'] ?>" class="btn btn-main mt-2">Ler mais</a>

                        </div>

                    </div>

                </div>

            <?php endforeach; ?>

        </div>

    </div>

</body>

</html>