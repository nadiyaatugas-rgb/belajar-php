<?php
// === KONFIGURASI DATABASE ===
$host = 'localhost';
$db   = 'belajar_php';
$user = 'root';
$pass = '';

$dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4;";

// === KONEKSI PDO (dipakai bersama oleh semua file) ===
try {
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Koneksi gagal: " . $e->getMessage());
}
