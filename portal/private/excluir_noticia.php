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

$pdo->prepare("DELETE FROM noticias WHERE id=?")->execute([$id]);

header('Location: dashboard.php');
