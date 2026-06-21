<?php
include 'config.php';

if (isset($_POST['submit'])) {

    $kode_produk = trim($_POST['kode_produk']);
    $name        = trim($_POST['name']);
    $harga       = $_POST['harga'];

    $sql = "INSERT INTO products (kode_produk, name, harga, stock)
            VALUES (:kode_produk, :name, :harga, 0)";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([
        ':kode_produk' => $kode_produk,
        ':name'        => $name,
        ':harga'       => $harga
    ]);

    // Redirect kembali ke index.php setelah data tersimpan
    header("Location: index.php?pesan=Produk berhasil ditambahkan");
    exit;
}
?>
<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tambah Produk</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB"
        crossorigin="anonymous">
</head>

<body>

    <nav class="navbar bg-primary navbar-dark mb-4">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">Simple ERP - Master Produk</a>
        </div>
    </nav>

    <div class="container">

        <h4 class="mb-3">Tambah Produk Baru</h4>

        <form method="POST" class="col-md-6">

            <div class="mb-3">
                <label for="kode_produk" class="form-label">Kode Produk (SKU)</label>
                <input type="text" class="form-control" id="kode_produk" name="kode_produk" required>
            </div>

            <div class="mb-3">
                <label for="productName" class="form-label">Nama Produk</label>
                <input type="text" class="form-control" id="productName" name="name" required>
            </div>

            <div class="mb-3">
                <label for="productPrice" class="form-label">Harga</label>
                <input type="number" step="0.01" class="form-control" id="productPrice" name="harga" required>
            </div>

            <button type="submit" name="submit" class="btn btn-primary">Simpan</button>
            <a href="index.php" class="btn btn-outline-secondary">Batal</a>

        </form>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>

</body>

</html>
