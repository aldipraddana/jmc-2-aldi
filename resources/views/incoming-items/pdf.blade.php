<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Data</title>
    <style>
        body {
            font-family: Calibri, sans-serif;
            font-size: 13px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Laporan Barang Datang </h2>
    <table>
        <tr><th>ID</th><td><?= $data['id'] ?></td></tr>
        <tr><th>Item Source</th><td><?= $data['item_source'] ?></td></tr>
        <tr><th>Reference Number</th><td><?= $data['reference_number'] ?></td></tr>
        <tr><th>Dibuat Oleh</th><td><?= $data['created_by']['name'] ?> (<?= $data['created_by']['email'] ?>)</td></tr>
        <tr><th>Kategori</th><td><?= $data['category']['category_name'] ?> (<?= $data['category']['category_code'] ?>)</td></tr>
        <tr><th>Sub Kategori</th><td><?= $data['sub_category']['sub_category_name'] ?></td></tr>
        <tr><th>Tanggal Dibuat</th><td><?= $data['created_at'] ?></td></tr>
    </table>
    
    <h3>Detail Item</h3>
    <table>
        <tr>
            <th>ID</th>
            <th>Nama Item</th>
            <th>Harga</th>
            <th>Jumlah</th>
            <th>Satuan</th>
            <th>Tanggal Kedaluwarsa</th>
            <th>Status</th>
        </tr>
        <?php foreach ($data['item_body'] as $item) : ?>
        <tr>
            <td><?= $item['id'] ?></td>
            <td><?= $item['item_name'] ?></td>
            <td><?= number_format($item['price'], 2, ',', '.') ?></td>
            <td><?= $item['quantity'] ?></td>
            <td><?= $item['unit'] ?></td>
            <td><?= $item['expired_date'] ?></td>
            <td><?= $item['status'] ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
