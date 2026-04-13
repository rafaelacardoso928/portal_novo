<?php
include 'backend/conexao.php';
include 'backend/funcoes.php';
session_start(); // 🔥 IMPORTANTE

$id = $_GET['id'];

$stmt = $pdo->prepare("
SELECT n.*, u.nome, c.nome as categoria 
FROM noticias n
JOIN usuarios u ON u.id=n.autor
JOIN categorias c ON c.id=n.categoria_id
WHERE n.id=?
");

$stmt->execute([$id]);
$n = $stmt->fetch();

if (!$n) {
    die("Notícia não encontrada");
}
?>

<!DOCTYPE html>
<html>

<head>
    <title><?= proteger($n['titulo']) ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <?php include 'navbar.php'; ?>

    <div class="container mt-5">

        <!-- 🔙 BOTÃO VOLTAR -->
        <a href="index.php" class="btn btn-outline mb-3">← Voltar</a>

        <h1><?= proteger($n['titulo']) ?></h1>

        <small>
            <?= $n['nome'] ?> | <?= $n['categoria'] ?> | <?= date('d/m/Y', strtotime($n['data'])) ?>
        </small>

        <?php if ($n['imagem']): ?>
            <img src="imagens/<?= $n['imagem'] ?>" class="img-fluid mt-3">
        <?php endif; ?>

        <p class="mt-3"><?= nl2br(proteger($n['noticia'])) ?></p>

        <br>

        <!-- 🔐 EDITAR / EXCLUIR (SÓ AUTOR) -->
        <?php if (isset($_SESSION['user']) && $_SESSION['user'] == $n['autor']): ?>

            <a href="private/editar_noticia.php?id=<?= $n['id'] ?>" class="btn-edit">Editar</a>

            <a href="private/excluir_noticia.php?id=<?= $n['id'] ?>" class="btn-delete"
                onclick="return confirm('Tem certeza que deseja excluir?')">
                Excluir
            </a>

        <?php endif; ?>

    </div>

</body>

</html>