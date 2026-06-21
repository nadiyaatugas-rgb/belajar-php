<?php
include 'config.php';

$id = $_GET['id'] ?? null;

if (!$id) {
    header("Location: index.php?pesan=ID produk tidak ditemukan");
    exit;
}

$sql = "DELETE FROM products WHERE id = :id";
$stmt = $pdo->prepare($sql);
$stmt->execute([':id' => $id]);

header("Location: index.php?pesan=Produk berhasil dihapus");
exit;
