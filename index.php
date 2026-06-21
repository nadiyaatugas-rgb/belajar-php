<?php
include 'config.php';

// READ: ambil semua data produk
$query = "SELECT * FROM products ORDER BY id ASC";
$stmt = $pdo->query($query);
$products = $stmt->fetchAll();

// Tangkap pesan status dari proses lain (tambah/edit/hapus/stok) lewat URL
$pesan = $_GET['pesan'] ?? '';
?>
<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Master Produk & Kontrol Stok</title>

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

        <?php if ($pesan): ?>
            <div class="alert alert-info"><?= htmlspecialchars($pesan) ?></div>
        <?php endif; ?>

        <div class="d-flex justify-content-between align-items-center mb-3">
            <h4 class="m-0">Katalog Produk</h4>
            <a href="tambah.php" class="btn btn-success">+ Tambah Produk</a>
        </div>

        <table class="table table-bordered table-striped align-middle">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Kode Produk</th>
                    <th>Nama Produk</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th style="width: 320px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($products) === 0): ?>
                    <tr>
                        <td colspan="6" class="text-center">Belum ada data produk.</td>
                    </tr>
                <?php endif; ?>

                <?php foreach ($products as $product): ?>
                    <tr>
                        <td><?= htmlspecialchars($product['id']) ?></td>
                        <td><?= htmlspecialchars($product['kode_produk'] ?? '-') ?></td>
                        <td><?= htmlspecialchars($product['name']) ?></td>
                        <td>Rp <?= htmlspecialchars(number_format($product['harga'], 0, ',', '.')) ?></td>
                        <td><?= htmlspecialchars($product['stock']) ?></td>
                        <td>
                            <div class="d-flex flex-wrap gap-1">
                                <a href="edit.php?id=<?= $product['id'] ?>" class="btn btn-sm btn-warning">Edit</a>

                                <a href="hapus.php?id=<?= $product['id'] ?>"
                                   class="btn btn-sm btn-danger"
                                   onclick="return confirm('Yakin hapus produk ini?');">Hapus</a>

                                <!-- Form Tambah Stok -->
                                <form action="update_stok.php" method="POST" class="d-flex gap-1">
                                    <input type="hidden" name="id" value="<?= $product['id'] ?>">
                                    <input type="hidden" name="action" value="tambah">
                                    <input type="number" name="qty" min="1" required
                                           class="form-control form-control-sm" style="width: 70px;" placeholder="qty">
                                    <button type="submit" class="btn btn-sm btn-primary">+ Stok</button>
                                </form>

                                <!-- Form Kurangi Stok -->
                                <form action="update_stok.php" method="POST" class="d-flex gap-1">
                                    <input type="hidden" name="id" value="<?= $product['id'] ?>">
                                    <input type="hidden" name="action" value="kurang">
                                    <input type="number" name="qty" min="1" required
                                           class="form-control form-control-sm" style="width: 70px;" placeholder="qty">
                                    <button type="submit" class="btn btn-sm btn-secondary">- Stok</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>

</body>

</html>
