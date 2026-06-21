<?php
include 'config.php';

// Ambil data yang dikirim lewat form POST
$id     = $_POST['id'] ?? null;
$action = $_POST['action'] ?? null;
$qty    = $_POST['qty'] ?? null;

// Validasi dasar
if (!$id || !$action || !$qty || $qty < 1) {
    header("Location: index.php?pesan=Data stok tidak valid");
    exit;
}

// Tentukan kueri berdasarkan jenis aksi (tambah / kurang)
if ($action === 'tambah') {
    $sql = "UPDATE products SET stock = stock + :qty WHERE id = :id";
} elseif ($action === 'kurang') {
    // Cek stok saat ini supaya tidak minus
    $cek = $pdo->prepare("SELECT stock FROM products WHERE id = :id");
    $cek->execute([':id' => $id]);
    $produk = $cek->fetch();

    if (!$produk || $produk['stock'] < $qty) {
        header("Location: index.php?pesan=Stok tidak cukup untuk dikurangi");
        exit;
    }

    $sql = "UPDATE products SET stock = stock - :qty WHERE id = :id";
} else {
    header("Location: index.php?pesan=Aksi stok tidak dikenali");
    exit;
}

// Eksekusi pakai prepared statement (aman dari SQL Injection)
$stmt = $pdo->prepare($sql);
$stmt->execute([
    ':qty' => $qty,
    ':id'  => $id
]);

header("Location: index.php?pesan=Stok berhasil diperbarui");
exit;
