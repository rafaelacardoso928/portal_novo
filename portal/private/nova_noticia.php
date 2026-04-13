<?php
include '../backend/conexao.php';
session_start();

if (!isset($_SESSION['user'])) {
    header("Location: ../login.php");
    exit;
}

if ($_POST) {

    $titulo = $_POST['titulo'];
    $noticia = $_POST['noticia'];
    $categoria_id = $_POST['categoria_id'];

    // 🔥 GARANTE QUE É NÚMERO
    $autor = (int) $_SESSION['user'];

    $imagem = null;

    if (!empty($_FILES['imagem']['name'])) {
        $nomeImagem = time() . "_" . $_FILES['imagem']['name'];
        move_uploaded_file($_FILES['imagem']['tmp_name'], "../imagens/" . $nomeImagem);
        $imagem = $nomeImagem;
    }

    $stmt = $pdo->prepare("
        INSERT INTO noticias (titulo, noticia, autor, categoria_id, imagem)
        VALUES (?, ?, ?, ?, ?)
    ");

    $stmt->execute([
        $titulo,
        $noticia,
        $autor,
        $categoria_id,
        $imagem
    ]);

    header("Location: ../index.php");
    exit;
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Nova Notícia</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../style.css">
</head>

<body>

    <?php include '../navbar.php'; ?>

    <div class="container mt-5">

        <h2>Nova Notícia</h2>

        <a href="../index.php" class="btn btn-outline mb-3">← Voltar</a>

        <form method="POST" enctype="multipart/form-data">

            <input type="text" name="titulo" placeholder="Título" class="form-control mb-2" required>

            <textarea name="noticia" placeholder="Conteúdo" class="form-control mb-2" required></textarea>

            <select name="categoria_id" class="form-control mb-2" required>
                <option value="">Selecione a categoria</option>
                <option value="1">Teatro</option>
                <option value="2">Cinema</option>
                <option value="3">Música</option>
            </select>

            <input type="file" name="imagem" class="form-control mb-2">

            <button class="btn btn-main">Publicar</button>

        </form>

    </div>

</body>

</html>