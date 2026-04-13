<?php if (session_status() === PHP_SESSION_NONE) session_start(); ?>

<nav class="navbar navbar-expand-lg navbar-custom">
    <div class="container">

        <a class="navbar-brand d-flex align-items-center" href="index.php">
            <img src="imagens/artertenews.png" class="logo">
        </a>

        <div class="nav-buttons">
            <?php if (isset($_SESSION['user'])): ?>
                <a href="private/nova_noticia.php" class="btn btn-main">+ Nova Notícia</a>
                <a href="logout.php" class="btn btn-outline">Sair</a>
            <?php else: ?>
                <a href="login.php" class="btn btn-outline">Login</a>
                <a href="cadastro.php" class="btn btn-main">Cadastro</a>
            <?php endif; ?>
        </div>

    </div>
</nav>