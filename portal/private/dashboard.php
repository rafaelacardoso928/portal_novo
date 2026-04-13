<?php
include '../backend/verifica_login.php';
include '../backend/conexao.php';

$stmt = $pdo->prepare("SELECT * FROM noticias WHERE autor=? ORDER BY data DESC");
$stmt->execute([$_SESSION['user']['id']]);
$noticias = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../style.css">
</head>

<body>

    <div class="container mt-4">

        <h2>Minhas Notícias</h2>

        <a href="nova_noticia.php" class="btn btn-primary mb-3">+ Nova Notícia</a>

        <?php if (count($noticias) == 0): ?>
            <p>Você ainda não publicou nenhuma notícia.</p>
        <?php endif; ?>

        <?php foreach ($noticias as $n): ?>

            <div class="card mb-3 p-3">

                <h4><?= $n['titulo'] ?></h4>

                <p><?= substr($n['noticia'], 0, 100) ?>...</p>

                <div>
                    <a href="editar_noticia.php?id=<?= $n['id'] ?>" class="btn btn-warning">Editar</a>

                    <a href="excluir_noticia.php?id=<?= $n['id'] ?>"
                        class="btn btn-danger"
                        onclick="return confirm('Tem certeza que deseja excluir?')">
                        Excluir
                    </a>
                </div>

            </div>

        <?php endforeach; ?>

    </div>

</body>

</html>