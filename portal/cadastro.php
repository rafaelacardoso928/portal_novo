<?php
include 'backend/conexao.php';

if ($_POST) {

    // Verifica se email já existe
    $check = $pdo->prepare("SELECT id FROM usuarios WHERE email=?");
    $check->execute([$_POST['email']]);

    if ($check->rowCount() > 0) {
        $erro = "Esse email já está cadastrado!";
    } else {

        $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

        $stmt = $pdo->prepare("INSERT INTO usuarios(nome,email,senha) VALUES(?,?,?)");
        $stmt->execute([
            $_POST['nome'],
            $_POST['email'],
            $senha
        ]);

        header('Location: login.php');
        exit;
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Cadastro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <div class="container mt-5">
        <div class="card p-4 mx-auto" style="max-width:400px;">

            <h2 class="text-center">Cadastro</h2>

            <?php if (isset($erro)): ?>
                <div class="alert alert-danger"><?= $erro ?></div>
            <?php endif; ?>

            <form method="post">
                <input name="nome" class="form-control mb-2" placeholder="Nome" required>
                <input name="email" type="email" class="form-control mb-2" placeholder="Email" required>
                <input name="senha" type="password" class="form-control mb-3" placeholder="Senha" required>

                <button class="btn btn-success w-100">Cadastrar</button>
            </form>

        </div>
    </div>

</body>

</html>