<?php
include 'backend/conexao.php';
session_start();

if ($_POST) {

    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE email=?");
    $stmt->execute([$email]);

    $user = $stmt->fetch();

    if ($user && password_verify($senha, $user['senha'])) {

        // ✅ SALVA SOMENTE O ID
        $_SESSION['user'] = $user['id'];

        header("Location: index.php");
        exit;
    } else {
        echo "Email ou senha inválidos";
    }
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>

<body>

    <?php include 'navbar.php'; ?>

    <div class="container mt-5">

        <h2>Login</h2>

        <form method="POST">

            <input type="email" name="email" placeholder="Email" class="form-control mb-2" required>

            <input type="password" name="senha" placeholder="Senha" class="form-control mb-2" required>

            <button class="btn btn-main">Entrar</button>

        </form>

    </div>

</body>

</html>