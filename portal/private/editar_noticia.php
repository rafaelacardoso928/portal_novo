<?php
include '../backend/verifica_login.php';
include '../backend/conexao.php';

$id = $_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM noticias WHERE id=?");
$stmt->execute([$id]);
$n = $stmt->fetch();

if (!$n) {
    die("Notícia não encontrada");
}

if ($n['autor'] != $_SESSION['user']['id']) {
    die("Acesso negado");
}

if ($_POST) {

    $img = $n['imagem'];

    if (!empty($_FILES['img']['name'])) {
        $img = time() . "_" . $_FILES['img']['name'];
        move_uploaded_file($_FILES['img']['tmp_name'], "../imagens/" . $img);
    }

    $pdo->prepare("UPDATE noticias SET titulo=?, noticia=?, categoria_id=?, imagem=? WHERE id=?")
        ->execute([
            $_POST['titulo'],
            $_POST['noticia'],
            $_POST['categoria'],
            $img,
            $id
        ]);

    header('Location: dashboard.php');
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Editar Notícia</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../style.css">
</head>

<body>

    <div class="container mt-4">

        <h2>Editar Notícia</h2>

        <form method="post" enctype="multipart/form-data">

            <input name="titulo" value="<?= $n['titulo'] ?>" class="form-control mb-2">

            <textarea name="noticia" class="form-control mb-2"><?= $n['noticia'] ?></textarea>

            <select name="categoria" class="form-control mb-2">
                <option value="1" <?= $n['categoria_id'] == 1 ? 'selected' : '' ?>>Teatro</option>
                <option value="2" <?= $n['categoria_id'] == 2 ? 'selected' : '' ?>>Cinema</option>
                <option value="3" <?= $n['categoria_id'] == 3 ? 'selected' : '' ?>>Música</option>
            </select>

            <input type="file" name="img" class="form-control mb-2">

            <button class="btn btn-success">Salvar</button>

        </form>

    </div>

</body>

</html>