<?php
// ข้อมูลสินค้าเหมือนกับใน index.php
$products = [
    1 => ['name' => 'มุ้งธรรมดา', 'price' => 1500, 'image' => 'images/mosquito_net1.jpg', 'description' => 'มุ้งธรรมดา ป้องกันแมลงได้ดี เหมาะสำหรับบ้านและสำนักงาน'],
    2 => ['name' => 'มุ้งพับได้', 'price' => 2000, 'image' => 'images/mosquito_net2.jpg', 'description' => 'มุ้งพับได้ กันแมลงได้สูงสุด เหมาะสำหรับพื้นที่ชื้น'],
    3 => ['name' => 'มุ้งเด็ก', 'price' => 1800, 'image' => 'images/mosquito_net3.jpg', 'description' => 'มุ้งเด็กช่วยลดฝุ่นละออง เหมาะกับคนเป็นภูมิแพ้'],
];

// ตรวจสอบว่ามีการส่ง id มาไหม และมีสินค้านั้นหรือเปล่า
if (!isset($_GET['id']) || !isset($products[$_GET['id']])) {
    // ถ้าไม่มีหรือไม่ถูกต้อง ให้กลับไปหน้า index
    header('Location: index.php');
    exit;
}

$id = $_GET['id'];
$product = $products[$id];
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8" />
    <title>รายละเอียดสินค้า - <?= htmlspecialchars($product['name']) ?></title>
    <link rel="stylesheet" href="css/style.css" />
</head>
<body>
    <header>
        <h1>ร้านขายมุ้งออนไลน์</h1>
        <nav>
            <a href="index.php">หน้าหลัก</a> |
            <a href="cart.php">ตะกร้าสินค้า</a>
        </nav>
    </header>

    <main>
        <div class="product-detail">
            <img src="<?= htmlspecialchars($product['image']) ?>" alt="<?= htmlspecialchars($product['name']) ?>" />
            <h2><?= htmlspecialchars($product['name']) ?></h2>
            <p class="price">ราคา <?= number_format($product['price']) ?> บาท</p>
            <p class="description"><?= htmlspecialchars($product['description']) ?></p>
            <a href="cart.php?action=add&id=<?= $id ?>" class="btn">เพิ่มลงตะกร้า</a>
        </div>
    </main>

    <footer>
        <p>© 2025 ร้านขายมุ้งออนไลน์</p>
    </footer>
</body>
</html>
