<?php
$products = [
    1 => ['name' => 'รองเท้าวิ่ง', 'price' => 1200, 'image' => 'images/shoes.jpg', 'desc' => 'รองเท้าวิ่งน้ำหนักเบา ใส่สบาย เหมาะสำหรับวิ่งระยะไกล'],
    2 => ['name' => 'เสื้อกีฬา', 'price' => 800, 'image' => 'images/shirt.jpg', 'desc' => 'เสื้อกีฬาเนื้อผ้าโปร่งระบายอากาศดี เหมาะสำหรับออกกำลังกาย'],
    3 => ['name' => 'นาฬิกาออกกำลังกาย', 'price' => 1500, 'image' => 'images/watch.jpg', 'desc' => 'นาฬิกาออกกำลังกาย มีฟังก์ชันวัดอัตราการเต้นหัวใจและนับก้าว'],
];

// ตรวจสอบ id ว่ามีในสินค้าไหม
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
if (!isset($products[$id])) {
    echo "ไม่พบสินค้านี้";
    exit;
}
$product = $products[$id];
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8" />
    <title>รายละเอียดสินค้า: <?= htmlspecialchars($product['name']) ?></title>
    <link rel="stylesheet" href="style.css" />
</head>
<body>
    <div class="container">
        <h1><?= htmlspecialchars($product['name']) ?></h1>
        <img src="<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>" style="max-width: 300px; border-radius:8px;">
        <p class="price"><?= number_format($product['price']) ?> บาท</p>
        <p><?= htmlspecialchars($product['desc']) ?></p>
        <a href="index.php" class="btn">← กลับไปหน้าสินค้า</a>
    </div>
</body>
</html>
