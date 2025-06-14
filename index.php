<?php
$products = [
    1 => ['name' => 'รองเท้าวิ่ง', 'price' => 1200, 'image' => 'images/shoes.jpg'],
    2 => ['name' => 'เสื้อกีฬา', 'price' => 800, 'image' => 'images/shirt.jpg'],
    3 => ['name' => 'นาฬิกาออกกำลังกาย', 'price' => 1500, 'image' => 'images/watch.jpg'],
];
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8" />
    <title>ร้านขายสินค้าออนไลน์</title>
    <link rel="stylesheet" href="style.css" />
</head>
<body>
    <h1>สินค้าทั้งหมด</h1>
    <div class="product-list">
        <?php foreach ($products as $id => $product): ?>
            <div class="product-item">
                <img src="<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>" />
                <h3><?= htmlspecialchars($product['name']) ?></h3>
                <p class="price"><?= number_format($product['price']) ?> บาท</p>
                <a href="product.php?id=<?= $id ?>" class="btn">ดูรายละเอียด</a>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
